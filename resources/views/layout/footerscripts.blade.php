	<!--begin::Javascript-->
    <script>var hostUrl ='{{asset('assets/')}}';</script>
    {{-- <script>var hostUrl = "../assets/";</script> --}}
     <!--begin::Global Javascript Bundle(used by all pages)-->



     <script src="{{asset('dist/assets/plugins/global/plugins.bundle.js')}}"></script>
     <script src="{{asset('dist/assets/js/scripts.bundle.js')}}"></script>
     <!--end::Global Javascript Bundle-->
     <!--begin::Page Vendors Javascript(used by this page)-->
     <script src="{{asset('dist/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
     <!--end::Page Vendors Javascript-->
     <!--begin::Page Custom Javascript(used by this page)-->
     <script src="{{asset('dist/assets/js/custom/apps/ecommerce/catalog/categories.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/apps/projects/users/users.js')}}"></script>

     <script src="{{asset('dist/assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
     <!--end::Page Vendors Javascript-->

{{-- select 2 --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script>
        $('#slct_srch').select2();
</script> --}}
{{-- eend of select 2 --}}
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{asset('dist/assets/js/custom/apps/ecommerce/catalog/save-product.js')}}"></script>

     <!--begin::Page Custom Javascript(used by this page)-->
     <script src="{{asset('dist/assets/js/custom/apps/ecommerce/catalog/save-category.js')}}"></script>
<!--begin::Page Custom Javascript(used by this page)-->

     <script src="{{asset('dist/assets/js/widgets.bundle.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/widgets.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/apps/chat/chat.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/utilities/modals/create-project/type.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/utilities/modals/create-project/budget.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/utilities/modals/create-project/settings.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/utilities/modals/create-project/team.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/utilities/modals/create-project/targets.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/utilities/modals/create-project/files.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/utilities/modals/create-project/complete.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/utilities/modals/create-project/main.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/utilities/modals/users-search.js')}}"></script>
     <script src="{{asset('dist/assets/js/custom/utilities/modals/new-target.js')}}"></script>


     @yield('scripts')
     <!--end::Page Custom Javascript-->
     <!--end::Javascript-->

