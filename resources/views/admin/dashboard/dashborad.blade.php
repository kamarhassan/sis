 @extends('admin.layouts.master')

 @section('content')
     <div id="example1"></div>
 @endsection


 @section('script')
     <script>
        //  $(document).ready(function() {
        //      // console.log(colummns_type);
        //      const container = document.getElementById('example');
          
        //      const hot = new Handsontable(container, {
        //          data: dataset,
        //          rowHeaders: true,
        //          colHeaders: true,
        //          colHeaders: header,
        //          // columns: colummns_type,
        //          height: 'auto',
        //          fixedColumnsStart: 1,
        //          formulas: {
        //              engine: hyperformulaInstance,
        //              sheetName: 'Sheet1'
        //          },
        //          readOnly: true,
        //          licenseKey: 'non-commercial-and-evaluation' // for non-commercial use only
        //      });
        //  });


         const container = document.getElementById('example1');

         const col = ['years', 'Tesla', 'Nissan','testing'];
             const data = [
                 ['2020', 10, 11,'ppp' ],
                 ['2017', 10, 11 ],
                 ['2018', 10, 11 ],
                 ['2019', 10, 11 ],
                 ['2021', 10, 11 ]
             ];

         const hot = new Handsontable(container, {
             data:data,
            //  startRows: 5,
            //  startCols: 5,
             height: 'auto',
             width: 'auto',
            //  colHeaders: true,
             colHeaders: col,
            //  minSpareRows: 1,
             licenseKey: 'non-commercial-and-evaluation'
         });
     </script>
 @endsection
