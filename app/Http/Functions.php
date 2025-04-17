<?php

//Key Value From Json
//====PARA Q LOS CHECKSBOS ESTEN CHEKEADOS
function kvfj($json, $key)
{
    if ($json == null) :
        return null;
    else :
        $json = $json;
        $json = json_decode($json, true);   //convertir el Json en arreglo
        if (array_key_exists($key, $json)) :
            return $json[$key];
        else :
            return null;
        endif;
    endif;
}

function getModulesArray()
{
    $a = [
        '0' => 'Acción',
        '1' => 'Animación',
        '2' => 'Aventura',
        '3' => 'Biografía',
        '4' => 'Ciencia Ficción',
        '5' => 'Comedia'

    ];
    return $a;
}

//ASIGANMOS ROLES Y SATADOS DE LAS PERSONAS QUE SE REGISTRARON
function getRoleUserArray($mode, $id)
{
    $roles = [
        '0' => 'Usuario normal',
        '1' => 'Administrador'
    ];

    if (!is_null($mode)) :
        return $roles;
    else :
        return $roles[$id];
    endif;
}

function getUserStatusArray($mode, $id)
{
    $status = [
        '0' => 'Registrado',
        '1' => 'Verificado',
        '100' => 'Baneado'
    ];

    if (!is_null($mode)) :
        return $status;
    else :
        return $status[$id];
    endif;
}


//otras funciones automatizadas lospeermisos casi automatico
function user_permissions()
{
    $p = [
        'dashboard' => [
            'icon' => '<i class="fas fa-home"></i>',
            'title' => ' Módulo de Dashboard',
            'keys' => [
                'dashboard' => ' Puede ver el dashboard',
                'dashboard_small_stats' => ' Puede ver las estadisticas rapidas',
                'dashboard_sell_today' => ' Puede ver ventas facturadas de hoy',
            ]
        ],
        'products' => [
            'icon' => '<i class="fas fa-boxes"></i>',
            'title' => 'Módulo de Productos',
            'keys' => [
                'products' => ' Puede ver el listado de productos',
                'product_add' => ' Puede agregar nuevos productos',
                'product_edit' => ' Puede editar productos',
                'product_search' => ' Puede buscar productos',
                'product_delete' => ' Puede eliminar productos',
                'product_gallery_add' => ' Puede agregar imágenes a galeria',
                'product_gallery_deleted' => ' Puede eliminar imágenes de galeria',
                'product_inventory' => ' Puede administrar el inventario',
            ]
        ],
        'categories' => [
            'icon' => '<i class="far fa-folder-open"></i>',
            'title' => ' Módulo de Categorías',
            'keys' => [
                'categories' => ' Puede ver la lista de categorias',
                'category_add' => ' Puede crear nuevas categorías',
                'category_edit' => ' Puede editar categorías',
                'category_delete' => ' Puede eliminar categorías',
            ]
        ],
        'users' => [
            'icon' => '<i class="far fa-user"></i>',
            'title' => ' Módulo de Categorías',
            'keys' => [
                'user_list' => ' Puede la lista de usuarios',
                'user_view' => ' Puede Ver el perfil del usuario',
                'user_edit' => ' Puede editar usuarios',
                'user_banned' => ' Puede bannear usuarios',
                'user_permissions' => ' Puede administrar permisos de usuarios',
            ]
        ],
        'sliders' => [
            'icon' => '<i class="far fa-images"></i>',
            'title' => ' Módulo de Sliders',
            'keys' => [
                'sliders_list' => ' Puede ver la lista de Sliders',
                'slider_add' => 'Puede crear Slieders',
                'slider_edit' => 'Puede editar los sliders',
                'slider_delete' => 'Puede eliminar los slider',
            ]
        ],
        'configuracion' => [
            'icon' => '<i class="fas fa-cogs"></i>',
            'title' => ' Módulo de Configuraciones',
            'keys' => [
                'configuracion' => ' Puede modificar la configuración',
            ]
        ],
        'orders' => [
            'icon' => '<i class="fas fa-clipboard-list"></i>',
            'title' => ' Módulo de Ordenes',
            'keys' => [
                'orders_list' => ' Puede ver el listado de ordenes',
                'order_view' => ' Puede ver el detalle de una orden',
                'orders_change_status' => ' Puede cambiar el estado de una orden',
            ]
        ],
        'coverage' => [
            'icon' => '<i class="fas fa-shipping-fast"></i>',
            'title' => ' Covertura de envios',
            'keys' => [
                'coverage_list' => ' Puede ver el listado de covertura de envios',
                'coverage_add' => ' Puede crear zonas de envio',
                'coverage_edit' => ' Puede editar zonas de envio',
                'coverage_delete' => ' Puede eliminar zonas de envio'
            ]
        ]

    ];
    return $p;
}


//Funcion para ver los datos deñ ususrio que puedan comprar y registarrse atras de 2002 18 años
function getUserYears()
{
    $ya = date('Y');
    $ym = $ya - 15;
    $yo = $ym - 62;
    return [$ym, $yo];
}

function getMonths($mode, $key)
{
    $m = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre',
    ];
    if ($mode == "list") {
        return $m;
    } else {
        return $m[$key];
    }
}
function getShippingMethod($method = null)
{
    $status = [
        '0' => 'Gratis',
        '1' => 'Precio fijo',
        '2' => 'Precio variable por hubicación',
        '3' => 'Valor fijo por producto',
        '4' => 'Envio gratis / Monto mínimo'
    ];

    if (is_null($method)) :
        return $status;
    else :
        return $status[$method];
    endif;
}
function getCoverageType($type = null)
{
    $status = [
        '0' => 'Departamento',
        '1' => 'Ciudad',
        '2' => 'Provincia',
        '3' => 'Pueblo'
    ];

    if (is_null($type)) :
        return $status;
    else :
        return $status[$type];
    endif;
}

function getCoverageStatus($status = null)
{
    $list = [
        '0' => 'No activo',
        '1' => 'Activo'
    ];

    if (is_null($status)) :
        return $list;
    else :
        return $list[$status];
    endif;
}


//Metodos de pago en laparte de configuraciones
function getEnableOrNot($status = null)
{
    $list = [
        '0' => 'No activo',
        '1' => 'Activo'
    ];

    if (is_null($status)) :
        return $list;
    else :
        return $list[$status];
    endif;
}

//AUN NOSEIMPLEMENTOOOOO
function getConfig($key){
    $var = config('cms.'.$key);
    return json_encode($var);
}

function getPaymentsMethods($method = null){
    $list = [
        '0' => 'Efectivo',
        '1' => 'Transferencia o deposito',
        '2' => 'Paypal',
        '3' => 'Tarjeta de crédito'
    ];

    if (is_null($method)) :
        return $list;
    else :
        return $list[$method];
    endif;
}

function getOrderStatus($status = null){
    $list = [
        '0' => 'En proceso',
        '1' => 'Pago pendiente de confirmación',
        '2' => 'Pago recibido',
        '3' => 'Procesando orden',
        '4' => 'Orden enviada',
        '5' => 'Listo para recoger',
        '6' => 'Orden entregada',
        '100' => 'Orden rechazada'
    ];

    if (is_null($status)) :
        return $list;
    else :
        return $list[$status];
    endif;
}

//FUNCION PARA EL HISTORIAL DE COMPRAS
function getOrderType($type = null){
    $list = [
        '0' => 'Entrega a domicilio',
        '1' => 'TO GO'
    ];

    if (is_null($type)) :
        return $list;
    else :
        return $list[$type];
    endif;
}

//para la moneda directmente
function number($number)
{
    return config('cms.currency') . ' ' . number_format($number, 2, '.',',');
}
