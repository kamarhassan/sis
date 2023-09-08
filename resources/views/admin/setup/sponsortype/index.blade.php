@extends('admin.layouts.master')
@section('title')
   @lang('site.sponsor')
@endsection

@section('css')
    @livewireStyles()
@endsection

@section('content')
    @include('admin.setup.sponsortype.create')
    @include('admin.setup.sponsortype.data-sponsor-fee-type')
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            //     var table = $('#example1').DataTable({
            //     scrollY: "400px",
            //     // scrollX: true,
            //     scrollCollapse: false,
            //     paging: false,
            //     order: [ 0, 'desc' ],
            //     // responsive: true,
            //     // ajax: '/test/0',

            // });



            var counter = 1;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                $("#sponsore_fee_type_number").attr("id", "sponsore_fee_type_" + counter);
                $("#sponsore_fee_type_number_error").attr("id", "sponsore_fee_type_" + counter + "_");

                // $(this).closest(".add_item").attr("id","whole_extra_item_add_"+counter);;

                counter++;
            });
            $(document).on("click", '.removeeventmore', function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            });
            // var table = $('#example1').DataTable({

            //       responsive: true,

            //       // ajax: '/test/0',

            //   });
        });
    </script>
@endsection
