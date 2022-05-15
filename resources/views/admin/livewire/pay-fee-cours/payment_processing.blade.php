@extends('admin.layouts.master')
@section('title')
    @lang('site.register Student in Course')
@endsection
@section('css')
    <style>


    </style>
@endsection

@section('content')
    @livewire('pay-fee-cours.payment')
@endsection



    @section('script')
    @livewireScripts
    <script>

        document.addEventListener('livewire:load', function() {
            console.table(4);
            // console.table(document.getElementById('payment_table'))

            // alert('das');
        })
        // $(document).ready(function() {
        //     var table = $('#payment_table').DataTable({
        //         scrollY: "300px",
        //         scrollX: true,
        //         scrollCollapse: true,
        //         paging: false,
        //         fixedColumns: {
        //             left: 1,
        //             right: 1
        //         }
        //     });
        // });






        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });
    </script>

    {{-- <script src="{{ URL::asset('assets/custome_js/std_register.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('assets/app-assets/js/pages/steps.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/assets/vendor_components/jquery-steps-master/build/jquery.steps.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script> --}}
@endsection