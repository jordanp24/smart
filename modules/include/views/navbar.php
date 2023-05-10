<script type="text/javascript">
    if (!sessionStorage.getItem('firstname')) location.href = "../../login/views/login.php";

    function validarRol() {
        let rawFile = new XMLHttpRequest();
        let file = null;
        if(sessionStorage.getItem('rol') == 1) file = "../../include/views/navbarAdmin.php";
        else if(sessionStorage.getItem('rol') == 2) file = "../../include/views/navbarEncagardo.php";
        else if(sessionStorage.getItem('rol') == 3) file = "../../include/views/navbarCobrador.php";
        rawFile.open("GET", file, false)
        rawFile.onreadystatechange = function(){
            if(rawFile.readyState === 4){
                if(rawFile.status === 200 || rawFile.status === 0){
                    document.write(rawFile.responseText)
                }
            }
        }
        rawFile.send(null);
        console.clear();
    }

    validarRol();
</script>