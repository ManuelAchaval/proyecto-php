

$("#form_catg").submit(function (e) {
    e.preventDefault();

    const categoria = $("#nombre_cat").val();
    if (!$.trim(categoria)) {
        alert("Complete el nombre de la categoría");
        return false;
    }
    alert(`Formulario enviado. \nCategoria "${categoria}" Creada exitosamente. `);
    this.reset();
    return true;
});


$("#form_prod").submit(function (e) {
    e.preventDefault();
    const nombre = $("#nom_prod").val();
    const descripcion = $("#desc_prod").val();
    const precio = $("#precio_prod").val();
    const imagen = $("#img_prod").val();
    const categoria = $("#cat_prod").val();

    const errores = [];

    if (!$.trim(nombre))
        errores.push(`"Nombre"`);
    if (!$.trim(descripcion))
        errores.push(`"Descripcion"`);
    if (!$.trim(precio))
        errores.push(`"Precio"`);
    if (!$.trim(imagen))
        errores.push(`"Imagen"`);
    if (!$.trim(categoria))
        errores.push(`"Categoria"`);
    
    if(errores.length>0){
        let mensaje ="Debe completar ";
        errores.forEach((error)=>{
            mensaje +="\n "+error;
        });
        alert(mensaje);
        return false;
    }
alert(`Formulario enviado. \nProducto "${(nombre)}" creada exitosamente`);
this.reset();
return true;


});