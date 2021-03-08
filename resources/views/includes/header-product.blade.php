<script src='{{ asset('js/okzoom.js') }}'></script>
<script>
    $(function(){
        $('#example').okzoom({
            width: 150,
            height: 150,
            border: "1px solid black",
            shadow: "0 0 5px #000"
        });
    });
</script>
