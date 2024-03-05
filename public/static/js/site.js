const base = location.protocol + '//' + location.host;
const route = document.getElementsByName('routeName')[0].getAttribute('content');     //extraendo los datos de las rutas de master.blade.php
//var slider = new MDSlider;
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
const currency = document.getElementsByName('currency')[0].getAttribute('content');
const auth = document.getElementsByName('auth')[0].getAttribute('content');     //paara saber si estan conectados y DARLE ME GUSTA O LKE con auth
var page = 1;
var page_section = "";
var products_list_ids_temp = [];

//funcion de terceros de https://kenwheeler.github.io/slick/
//===INICIALIZANDO EL carrusel de imageenes
$(document).ready(function () {
    $('.slick-slider').slick();
});

//cuando la pantalla se cargue por compleot
window.onload = function () {
    loader.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {

    var page_route_name = document.getElementsByClassName('lk-' + route)[0];   //PARA QUE LA BARRA DE NAVEGACION QUEDE MARCADO para saber donde estamos
    if(page_route_name){
        page_route_name.classList.add('active');
    }
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl){
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    var loader = document.getElementById('loader');
    //console.log(products_list_ids_temp);
    var slider = new MDSlider;

    var btn_avatar_edit = document.getElementById('btn_avatar_edit');   //
    var input_file_avatar = document.getElementById('input_file_avatar');       //abrir el archivo explorer
    var form_avatar_change = document.getElementById('form_avatar_change');
    var avatar_change_overlay = document.getElementById('avatar_change_overlay');     //avatar_change_overlay
    var products_list = document.getElementById('products_list');
    var load_more_products = document.getElementById('load_more_products');

    //elemento escucha
    if (btn_avatar_edit) {
        btn_avatar_edit.addEventListener('click', function (e) {
            e.preventDefault();
            //console.log('avatar');
            input_file_avatar.click();  //nos habre aarchivo para subir imagen
        })
    }

    if (load_more_products) {
        load_more_products.addEventListener('click', function (e) {
            e.preventDefault();
            load_products(page_section);  //nos habre aarchivo para subir imagen
        })
    }

    if (input_file_avatar) {
        input_file_avatar.addEventListener('change', function () {
            var load_img = '<img src="' + base + '/static/images/loader_white.gif"/>';
            avatar_change_overlay.innerHTML = load_img;
            avatar_change_overlay.style.display = 'flex';
            form_avatar_change.submit();      //se recarga la imagaen y te manda al  controlador
        })
    }
    slider.show();

    if (route == "home") {
        load_products('home');
    }
    if (route == "store") {
        load_products('store');
    }
    if (route == "store_category") {
        //var object_id = document.getElementsByName('category_id')[0].getAttribute('content');
        load_products('store_category');//, object_id);
    }
    /*if (route == "search") {
        //var object_id = document.getElementsByName('category_id')[0].getAttribute('content');
        //load_products('store_category');//, object_id);
        mark_user_favorites([document.getElementsByName('product_id')[0].getAttribute('content')]);
    }*/

    //PARA AGREGAR LA DIRECCIOM DE CADA CLIENTE
    if(route == "account_address"){
        var state = document.getElementById('state');
        if(state){
            state.addEventListener('change', load_cities);
        }
        load_cities();
        //console.log(state);
    }
    //hasta aqui

    if(route == "product_single"){
        //console.log(route);
        //load_product_variants();
        var inventory = document.getElementsByClassName('inventory');
        for (i = 0; i < inventory.length; i++) {
            inventory[i].addEventListener('click', function (e) {
                e.preventDefault();
                load_product_variants(this.getAttribute('data-inventory-id'));
            });
        }
        mark_user_favorites([document.getElementsByName('product_id')[0].getAttribute('content')]);

        var amount_action  =  document.getElementsByClassName('amount_action');
        for (i = 0; i < amount_action.length; i++) {
            amount_action[i].addEventListener('click', function (e) {
                e.preventDefault();
                product_single_amount(this.getAttribute('data-action'));
            });
        }
    }
    btn_deleted = document.getElementsByClassName('btn-deleted');
    //console.log(btn_deleted.length);
    for (i = 0; i < btn_deleted.length; i++) {
        btn_deleted[i].addEventListener('click', delete_object);
    }

    //para que se quede seleccionado los botones de pagos
    var method_payment_btn = document.getElementsByClassName('btn-payment-method');
    if(method_payment_btn){
        method_payment_btn_selected = null;
        for(i=0; i < method_payment_btn.length; i++){
            method_payment_btn[i].addEventListener('click', function(e){
                e.preventDefault();
                //console.log(method_payment_btn_selected);
                if(method_payment_btn_selected){
                    document.getElementById(method_payment_btn_selected).classList.remove('active');
                }
                this.classList.add('active');
                document.getElementById('field_payment_method_id').value = this.getAttribute('data-payment-method-id');
                document.getElementById('pay_btn_complete').classList.remove('disabled');   //para activar elboton de Completar Orden
                method_payment_btn_selected = this.getAttribute('id');
            });
        }
    }
});


function load_products(section) {
    loader.style.display = 'flex';  //imagen de carga
    page_section = section;
    if (section == "store_category") {
        var object_id = document.getElementsByName('category_id')[0].getAttribute('content');
        //console.log(csrfToken);
        var url = base + '/md/api/load/products/' + page_section+'?page='+page+'&object_id='+object_id;
    }else{
        var url = base + '/md/api/load/products/' + page_section+'?page='+page;
    }
    //console.log(url);
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            loader.style.display = 'none';      //imagen de carga desactivado
            page = page + 1;
            //console.log(page);
            var data = this.responseText;
            data = JSON.parse(data);
            //console.log(data.data);

            if (data.data.length == 0) {
                load_more_products.style.display = "none";
            }
            data.data.forEach(function (product, index) {
                products_list_ids_temp.push(product.id);
                //console.log(product.name);
                var div = "";
                div += "<div class=\"product\">";
                    div += "<div class=\"image\">"
                        div += "<div class=\"overlay\">";
                            div += "<div class=\"btns\">";
                                div += "<a href=\"" + base + "/product/" + product.id + "/" + product.slug + "\"><i class=\"fas fa-eye\"></i></a>";
                                div += "<a href=\"#\"><i class=\"fas fa-cart-plus\"></i></a>";
                                if(auth == "1"){
                                    div += "<a href=\"#\" id=\"favorite_1_" + product.id + "\" onclick=\"add_to_favorites('" + product.id + "', '1'); return false;\"> <i class=\"fas fa-heart\"></i></a>";
                                }else{
                                    div += "<a href=\"#\" id=\"favorite_1_" + product.id + "\" onclick=\"Swal.fire({title: 'Ooops...', text: 'Para agregar a favoritos necesitas iniciar sesion', icon: 'warning'}); return false;\"> <i class=\"fas fa-heart\"></i></a>";
                                }
                            div += "</div>";
                        div += "</div>";
                        div += "<img src=\"" + base + "/uploads/" + product.file_path + "/t_" + product.image + "\">";
                    div += "</div>";

                    div += "<a href=\"" + base + "/product/" + product.id + "/" + product.slug + "\" title=\""+product.name+"\">";
                        div += "<div class=\"title\">" + product.name + "</div>";
                        div += "<div class=\"price\">" + product.price + " " + currency + "</div>";
                        div += "<div class=\"options\"></div>";
                    div += "</a>";
                div += "</div>";
                products_list.innerHTML += div;
            });
            //console.log(products_list_ids_temp);
            if(auth == "1"){
                mark_user_favorites(products_list_ids_temp);
                products_list_ids_temp = [];
                //console.log(products_list_ids_temp);
            }
        } else {
            //Mensaje de error
        }

    }
}

//funcion para añadir a favoritos
function mark_user_favorites(objects) {
    //console.log(products);
    var url = base + '/md/api/load/user/favorites';
    var params = 'module=1&objects='+objects;
    //console.log(objects);
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); // no mandar de forma correcta sin esta linea de codigo el metdo POST ====decir encodee toda la data del formulario
    http.send(params);
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            //console.log(data);
            data = JSON.parse(data);
            if(data.count > "0"){
                data.objects.forEach(function (favorite, index) {
                    document.getElementById('favorite_1_' + favorite).removeAttribute('onclick');
                    document.getElementById('favorite_1_' + favorite).classList.add('favorite_active');
                });
            }
        }
    }
}

function add_to_favorites(object, module)
{
    url = base + '/md/api/favorites/add/' + object + '/' + module;
    //console.log(url);
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            data = JSON.parse(data);
            if (data.status == "success") {
                document.getElementById('favorite_' + module + '_' + object).removeAttribute('onclick');
                document.getElementById('favorite_' + module + '_' + object).classList.add('favorite_active');
            }else{
                document.getElementById('favorite_' + module + '_' + object).removeAttribute('onclick');
                document.getElementById('favorite_' + module + '_' + object).classList.add('favorite_active');
            }
        }
    }
}

//  ========== para visualizar el precioo de forma dinamica
function load_product_variants(inventory_id) {
        //FOREACH PARA ====== ACTIVAR Y DESACTIVAR LOS BOTONES
    document.getElementById('variants_div').style.display = 'none';
    document.getElementById('variants').innerHTML = ""; //pra recetear el campo de html creado autmoatico de la lista de variantes
    document.getElementById('field_variant').value = null;  //para recetar el precio de las variantes
    loader.style.display = 'flex';
    var inventory_list = document.getElementsByClassName('inventory');
    for (i = 0; i < inventory_list.length; i++) {
        inventory_list[i].classList.remove('active');
    }

    var product_id = document.getElementsByName('product_id')[0].getAttribute('content');
    //var inv = this.getAttribute('data-inventory-id');
    var inv = inventory_id;
    document.getElementById('field_inventory').value = inv;
    //this.classList.add('active');
    document.getElementById('inventory_'+ inv).classList.add('active');

    var url = base + '/md/api/load/product/inventory/' + inv + '/variants';
    //var params = 'module=1&objects='+objects;
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    //http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            loader.style.display = 'none';
            var data = this.responseText;
            //console.log(data);
            data = JSON.parse(data);
            if (data.length > 0) {
                document.getElementById('variants_div').style.display = 'block';
                data.forEach(function (element, index) {
                    variant = '';
                    variant += '<li>';
                        variant += '<a href="#" class="variant" onclick="variants_active_remove(); document.getElementById(\'field_variant\').value = ' + element.id + '; this.classList.add(\'active\'); return false;">';
                        variant += element.name;
                        variant += '</a>';
                    variant += '</li>';
                    document.getElementById('variants').innerHTML += variant;
                });
            }
            //console.log(data);
            console.log(data.length);
        }
    }
    //console.log('Producto: '+product_id,'Inventario: '+ inv);
}

function variants_active_remove() {
    var li_variants = document.getElementsByClassName('variant');
    for (i = 0; i < li_variants.length; i++) {
        li_variants[i].classList.remove('active');
    }
}

//AUMENTAR LA CATIDAD DE PRODUCTOS
function product_single_amount(action) {
    //console.log(action);
    var quantity = document.getElementById('add_to_cart_quantity');
    if(action == "plus"){
        var new_quantity = parseInt(quantity.value) + parseInt(1);
        quantity.value = parseInt(new_quantity);
    }
    if(action == "minus"){
        if (parseInt(quantity.value) > 1) {
            new_quantity = parseInt(quantity.value) - parseInt(1);
            quantity.value = parseInt(new_quantity);
        }
    }
}

function load_cities(){
    loader.style.display = 'flex';
    state_id = document.getElementById('state');
    cities_select = document.getElementById('address_city');
    cities_select.innerHTML = "";

    var url = base + '/md/api/load/cities/'+state_id.value;
    //var params = 'module=1&objects='+objects;
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    //http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            loader.style.display = 'none';
            var data = this.responseText;
            //console.log(data);
            data = JSON.parse(data);
            //console.log(data);
            if(data.length > 0){
                data.forEach(function(element, index){
                    cities_select.innerHTML += '<option value="'+element.id+'">'+element.name+'</option>';
                })
            }
        }
    }
    http.send();
}





function delete_object(e) {
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');
    var url = base + '/' + path + '/' + object + '/' + action;
    //console.log(object, path, url);

    var title, text, icon;

    if (action == "delete") {
        title = "¿Estás seguro de eliminar este producto?";
        text = " ¡Recuerda que esta acción se enviará a la papelera o lo eliminara de forma permanente! ";
        icon = "warning";
    }
    if (action == "restore") {
        title = "¿Quieres reestaurar este elemento?";
        text = " ¡Esta accion restaurará este elemento y esta activo en la base de datos! ";
        icon = "info";
    }

    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '&nbsp;&nbsp;&nbsp; Ok &nbsp;&nbsp;&nbsp;'

    })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
}
