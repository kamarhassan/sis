
 function printarea() {
      var printContents = document.getElementById('print').innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      location.reload();



    //   var divToPrint=document.getElementById("print");
    //   newWin= window.open("");
    //   newWin.document.write(divToPrint.outerHTML);
    //   newWin.print();
    //   newWin.close();

 }
