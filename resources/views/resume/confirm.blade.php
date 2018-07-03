<script>
    var x = confirm("Are you sure delete");
    var website = window.location.search;
    if (x) {
        // window.location.href="http://127.0.0.1:81/public/admin/delete"+website+"&status=true"
        window.location.href="{{asset("admin/delete")}}"+website+"&status=true"
    } else {
        window.location.href="{{asset("admin/delete")}}"
    }
</script>