<script>

  //click field 1
  // $(document).ready(function() {
  //   $("#widthTh1").click();
  // });

  // delete
  $('.btnDelete').click(function(event) {
    var a = $(this);
    var url = a.prop( 'href' );
    event.preventDefault()
    swal({
      title: "ต้องการลบ?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      window.location.href=url
    });
    });
</script>
