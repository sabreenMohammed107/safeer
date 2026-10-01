{{--
    Shared "choose from server" library, rendered once per page by the first
    admin.partials.image-picker. Only the empty modal is rendered here: images
    are fetched from ImageLibraryController in batches (newest first: 6, then 10 per "Load more") when the
    modal opens, on "Load more" / scrolling down, and on search.
    The modal is moved to <body> on load so it also works when the picker sits
    inside another modal.
--}}
<style>
    #serverImageLibrary .library-item.selected { outline: 3px solid var(--bs-primary, #009ef7); outline-offset: -3px; }
    #serverImageLibrary .library-item .library-check { display: none; }
    #serverImageLibrary .library-item.selected .library-check { display: flex; }
</style>

<div class="modal fade" id="serverImageLibrary" tabindex="-1" aria-labelledby="serverImageLibraryLabel" aria-hidden="true"
    data-url="{{ route('admin.image-library') }}" data-uploads="{{ asset('uploads') }}/">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="serverImageLibraryLabel">Server images <span data-role="total"></span></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header py-3">
                <input type="search" data-role="search" class="form-control form-control-sm form-control-solid"
                    placeholder="Search by image name..." />
            </div>
            <div class="modal-body" data-role="body">
                <div class="row g-4" data-role="grid"></div>
                <div data-role="status" class="text-center text-muted py-10"></div>
                <div class="text-center pt-6" data-role="more-wrap" style="display: none;">
                    <button type="button" class="btn btn-light-primary" data-role="more">Load more</button>
                </div>
            </div>
            <div class="modal-footer" data-role="multi-footer" style="display: none;">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" data-role="done">Use selected (<span data-role="count">0</span>)</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Move the library out of any parent form/modal/table right away (before
    // DataTables can detach table rows): a fixed modal nested in a transformed
    // .modal-dialog would be positioned relative to it.
    document.body.appendChild(document.getElementById('serverImageLibrary'));

    document.addEventListener('DOMContentLoaded', function () {
        var modalEl = document.getElementById('serverImageLibrary');
        if (!modalEl) return;

        var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        var body = modalEl.querySelector('[data-role="body"]');
        var grid = modalEl.querySelector('[data-role="grid"]');
        var statusEl = modalEl.querySelector('[data-role="status"]');
        var moreWrap = modalEl.querySelector('[data-role="more-wrap"]');
        var moreBtn = modalEl.querySelector('[data-role="more"]');
        var search = modalEl.querySelector('[data-role="search"]');
        var footer = modalEl.querySelector('[data-role="multi-footer"]');
        var countEl = modalEl.querySelector('[data-role="count"]');
        var totalEl = modalEl.querySelector('[data-role="total"]');
        var uploadsBase = modalEl.dataset.uploads;

        // Paging state. `requestId` drops responses that a newer search overtook.
        var hasMore = true;
        var busy = false;
        var term = '';
        var requestId = 0;
        var loadedOnce = false;
        var activePicker = null;
        var selected = [];

        // Paths stay in the hidden inputs only; the UI shows just the image name.
        function imageInfo(path) {
            return { url: uploadsBase + path, name: path.split('/').pop() };
        }

        function items() {
            return Array.prototype.slice.call(modalEl.querySelectorAll('[data-role="choose"]'));
        }

        var spinner = '<span class="spinner-border text-primary"></span>';

        // Fetch the next page (or the first page of a new search when `reset`).
        function loadPage(reset) {
            if (reset) {
                hasMore = true;
                grid.innerHTML = '';
            }
            if (!hasMore || (busy && !reset)) return;

            busy = true;
            var myRequest = ++requestId;
            statusEl.innerHTML = spinner;
            statusEl.style.display = '';
            moreWrap.style.display = 'none';

            // offset = images already shown; the server sends 6 first, then 10 at a time.
            var offset = grid.querySelectorAll('[data-role="item"]').length;
            var url = modalEl.dataset.url + '?offset=' + offset + '&q=' + encodeURIComponent(term);
            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                credentials: 'same-origin'
            })
                .then(function (response) {
                    if (response.ok) return response.json();
                    // Surface the server's reason (the endpoint returns one as JSON).
                    return response.json().catch(function () { return {}; }).then(function (data) {
                        throw new Error(data.message || ('Server error ' + response.status));
                    });
                })
                .then(function (data) {
                    if (myRequest !== requestId) return;
                    hasMore = data.has_more;
                    loadedOnce = true;
                    grid.insertAdjacentHTML('beforeend', data.html);
                    // complete=false: the server ran out of its time budget while
                    // indexing a very large uploads folder; later requests add the rest.
                    totalEl.textContent = '(' + data.total + (data.complete === false ? '+, still indexing…' : '') + ')';
                    statusEl.innerHTML = data.total ? '' : (term ? 'No matching images.' : 'No images found in public/uploads.');
                    statusEl.style.display = data.total ? 'none' : '';
                    moreWrap.style.display = hasMore ? '' : 'none';
                    markSelected();
                })
                .catch(function (error) {
                    if (myRequest !== requestId) return;
                    var message = document.createElement('span');
                    message.className = 'text-danger';
                    message.textContent = (error && error.message && error.message.indexOf('Could not load') === 0)
                        ? error.message : 'Could not load the images.';
                    statusEl.innerHTML = '';
                    statusEl.appendChild(message);
                    statusEl.insertAdjacentHTML('beforeend',
                        ' <button type="button" class="btn btn-sm btn-light ms-2" data-role="retry">Retry</button>');
                    statusEl.style.display = '';
                })
                .then(function () {
                    if (myRequest === requestId) busy = false;
                });
        }

        moreBtn.addEventListener('click', function () { loadPage(false); });
        statusEl.addEventListener('click', function (e) {
            if (e.target.closest('[data-role="retry"]')) loadPage(!loadedOnce);
        });

        // Load the next page when the user scrolls near the bottom of the grid.
        body.addEventListener('scroll', function () {
            if (body.scrollTop + body.clientHeight >= body.scrollHeight - 150) loadPage(false);
        }, { passive: true });

        // Preload the first page once the page is idle, so the grid is already
        // there when "Choose from server" is clicked. The images themselves are
        // lazy and the modal is hidden, so this costs only one small request.
        window.addEventListener('load', function () {
            var start = function () { if (!loadedOnce && !busy) applySearch(); };
            if ('requestIdleCallback' in window) requestIdleCallback(start, { timeout: 2000 });
            else setTimeout(start, 500);
        });

        function isMultiple(picker) { return picker.dataset.multiple === '1'; }

        function libraryValues(picker) {
            return Array.prototype.map.call(
                picker.querySelectorAll('input[type="hidden"][name="' + picker.dataset.libraryName + '"]'),
                function (input) { return input.value; }
            ).filter(Boolean);
        }

        function setLabel(picker, text) {
            picker.querySelector('[data-role="source-label"]').textContent = text || '';
        }

        function showSingle(picker, src, label) {
            var preview = picker.querySelector('[data-role="preview"]');
            preview.src = src;
            preview.style.display = '';
            picker.querySelector('[data-role="placeholder"]').style.display = 'none';
            setLabel(picker, label);
        }

        function renderMultiple(picker, paths) {
            var list = picker.querySelector('[data-role="library-list"]');
            var thumbs = picker.querySelector('[data-role="thumbs"]');
            list.innerHTML = '';
            thumbs.innerHTML = '';
            paths.forEach(function (path) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = picker.dataset.libraryName;
                input.value = path;
                list.appendChild(input);

                var info = imageInfo(path);
                var img = document.createElement('img');
                img.src = info.url;
                img.title = info.name;
                img.className = 'rounded border';
                img.style.cssText = 'width:60px;height:60px;object-fit:cover;';
                thumbs.appendChild(img);
            });
            setLabel(picker, paths.length ? paths.length + ' image(s) from server' : '');
        }

        function markSelected() {
            items().forEach(function (item) {
                item.classList.toggle('selected', selected.indexOf(item.dataset.path) !== -1);
            });
            countEl.textContent = selected.length;
        }

        var searchTimer = null;
        function applySearch() {
            var next = search.value.trim();
            if (next === term && loadedOnce) return;
            term = next;
            loadPage(true);
        }

        // Open the library for the picker whose button was clicked.
        document.addEventListener('click', function (e) {
            var button = e.target.closest('[data-role="open-library"]');
            if (!button) return;

            activePicker = button.closest('[data-image-picker]');
            selected = isMultiple(activePicker) ? libraryValues(activePicker) : [];
            footer.style.display = isMultiple(activePicker) ? '' : 'none';
            markSelected();
            modal.show();
            // First open loads the newest images; reopening keeps what was
            // already loaded unless a search was left in the box.
            // (A preload already in flight is left to finish.)
            if ((!loadedOnce && !busy) || search.value.trim() !== '') {
                search.value = '';
                applySearch();
            }
        });

        // Single: pick, clear the upload, preview, close. Multiple: toggle.
        modalEl.addEventListener('click', function (e) {
            var item = e.target.closest('[data-role="choose"]');
            if (!item || !activePicker) return;
            var path = item.dataset.path;

            if (isMultiple(activePicker)) {
                var i = selected.indexOf(path);
                if (i === -1) selected.push(path); else selected.splice(i, 1);
                markSelected();
                return;
            }

            activePicker.querySelector('[data-role="library"]').value = path;
            activePicker.querySelector('[data-role="file"]').value = '';
            showSingle(activePicker, item.dataset.url, 'Selected from server: ' + item.dataset.name);
            modal.hide();
        });

        modalEl.querySelector('[data-role="done"]').addEventListener('click', function () {
            if (activePicker) renderMultiple(activePicker, selected);
            modal.hide();
        });

        search.addEventListener('keydown', function (e) { if (e.key === 'Enter') e.preventDefault(); });
        search.addEventListener('input', function () {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(applySearch, 300);
        });

        // Stack above a parent add/edit modal, and keep the parent scrollable after closing.
        modalEl.addEventListener('shown.bs.modal', function () {
            var backdrops = document.querySelectorAll('.modal-backdrop');
            if (backdrops.length > 1) {
                backdrops[backdrops.length - 1].style.zIndex = 1060;
                modalEl.style.zIndex = 1065;
            }
        });
        modalEl.addEventListener('hidden.bs.modal', function () {
            modalEl.style.zIndex = '';
            if (document.querySelector('.modal.show')) document.body.classList.add('modal-open');
        });

        // Uploading from the device clears a single picker's library pick, so the two never conflict.
        // Multiple pickers keep both: uploads and library picks each become their own row.
        document.addEventListener('change', function (e) {
            var fileInput = e.target;
            if (!fileInput.matches('[data-image-picker] [data-role="file"]')) return;
            var picker = fileInput.closest('[data-image-picker]');
            if (isMultiple(picker) || !fileInput.files || !fileInput.files.length) return;

            picker.querySelector('[data-role="library"]').value = '';
            var reader = new FileReader();
            reader.onload = function (ev) {
                showSingle(picker, ev.target.result, 'New upload: ' + fileInput.files[0].name);
            };
            reader.readAsDataURL(fileInput.files[0]);
        });

        // Restore picks after a validation redirect.
        document.querySelectorAll('[data-image-picker]').forEach(function (picker) {
            var picks = libraryValues(picker);
            if (!picks.length) return;
            if (isMultiple(picker)) {
                renderMultiple(picker, picks);
            } else {
                var info = imageInfo(picks[0]);
                showSingle(picker, info.url, 'Selected from server: ' + info.name);
            }
        });
    });
</script>
