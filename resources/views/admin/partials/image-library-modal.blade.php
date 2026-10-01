{{--
    Shared "choose from server" library, rendered once per page by the first
    admin.partials.image-picker. Only the empty modal is rendered here: the
    image grid (image-library-items) is fetched from ImageLibraryController the
    first time the modal is opened, so pages don't scan public/uploads on load.
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
                <div class="text-center py-10"><span class="spinner-border text-primary"></span></div>
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
        var search = modalEl.querySelector('[data-role="search"]');
        var footer = modalEl.querySelector('[data-role="multi-footer"]');
        var countEl = modalEl.querySelector('[data-role="count"]');
        var totalEl = modalEl.querySelector('[data-role="total"]');
        var uploadsBase = modalEl.dataset.uploads;

        var loading = null; // promise of the grid fetch; null until first open (or after a failure)
        var activePicker = null;
        var selected = [];

        // Paths stay in the hidden inputs only; the UI shows just the image name.
        function imageInfo(path) {
            return { url: uploadsBase + path, name: path.split('/').pop() };
        }

        function items() {
            return Array.prototype.slice.call(modalEl.querySelectorAll('[data-role="choose"]'));
        }

        function loadLibrary() {
            if (loading) return loading;
            loading = fetch(modalEl.dataset.url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' },
                credentials: 'same-origin'
            })
                .then(function (response) {
                    if (!response.ok) throw new Error(response.status);
                    return response.text();
                })
                .then(function (html) {
                    body.innerHTML = html;
                    var grid = body.querySelector('[data-role="grid"]');
                    totalEl.textContent = grid ? '(' + grid.dataset.total + ')' : '';
                    markSelected();
                    applySearch();
                })
                .catch(function () {
                    loading = null; // let the next open retry
                    body.innerHTML = '<div class="text-center text-danger py-10">Could not load the images. Close and try again.</div>';
                });
            return loading;
        }

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

        function applySearch() {
            var term = search.value.trim().toLowerCase();
            var visible = 0;
            modalEl.querySelectorAll('[data-role="item"]').forEach(function (item) {
                var match = item.dataset.search.indexOf(term) !== -1;
                item.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            var empty = modalEl.querySelector('[data-role="empty"]');
            if (empty) empty.style.display = visible ? 'none' : '';
        }

        // Open the library for the picker whose button was clicked.
        document.addEventListener('click', function (e) {
            var button = e.target.closest('[data-role="open-library"]');
            if (!button) return;

            activePicker = button.closest('[data-image-picker]');
            selected = isMultiple(activePicker) ? libraryValues(activePicker) : [];
            footer.style.display = isMultiple(activePicker) ? '' : 'none';
            search.value = '';
            applySearch();
            markSelected();
            modal.show();
            loadLibrary();
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
        search.addEventListener('input', applySearch);

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
