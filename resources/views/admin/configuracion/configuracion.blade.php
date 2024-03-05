@extends('admin.master')

@section('title', 'Configuraciones')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/configuracion') }}"><i class="fas fa-cogs"></i> Configuraciones</a>
</li>
@endsection

@section('content')
<div class="container-fluid">

    {!! Form::open(['url' => '/admin/configuracion']) !!}

    {{--  Row #1  --}}
    <div class="row">
        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-cogs"></i> Configuraciones generales</h2>
                </div>
                <div class="inside">
                    <label for="name">Nombre de la tienda</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa fa-building"></i>
                        </span>
                        {!! Form::text('name', Config::get('cms.name'), ['class' => 'form-control']) !!}
                    </div>
                    <label for="webside" class="mtop16">Sitio web</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fab fa-chrome"></i>
                        </span>
                        {!! Form::text('webside', Config::get('cms.webside'), ['class' => 'form-control']) !!}
                    </div>
                    <label for="company_phone" class="mtop16">Teléfono</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-mobile"></i>
                        </span>
                        {!! Form::number('company_phone', Config::get('cms.company_phone'), ['class' =>
                        'form-control']) !!}
                    </div>
                    <label for="email_from" class="mtop16">Correo electronico remitente</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-at"></i>
                        </span>
                        {!! Form::email('email_from', Config::get('cms.email_from'), ['class' =>
                        'form-control']) !!}
                    </div>
                    <label for="map" class="mtop16">Ubicaciones</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-map"></i>
                        </span>
                        {!! Form::text('map', Config::get('cms.map'), ['class' => 'form-control']) !!}
                    </div>
                    <label for="maintenance_mode" class="mtop16">Modo mantenimiento</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-cog"></i>
                        </span>
                        {!! Form::select('maintenance_mode', ['0' => 'Desactivado', '1' => 'Activo'],
                        Config::get('cms.maintenance_mode'), ['class' => 'form-select']) !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- =========== --}}
        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-coins"></i> Moneda y precios</h2>
                </div>
                <div class="inside">
                    <label for="currency"> Símbolo de Moneda</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-money-bill"></i>
                        </span>
                        {!! Form::text('currency', Config::get('cms.currency'), ['class' => 'form-control']) !!}
                    </div>
                    <label for="shop_min_amount" class="mtop16">Monto mínimo de compra</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-compress-arrows-alt"></i>
                        </span>
                        {!! Form::text('shop_min_amount', Config::get('cms.shop_min_amount'), ['class' =>
                        'form-control', 'min' => '1', 'required']) !!}
                    </div>
                    <label for="products_per_page" class="mtop16">Configuracion precios de envio</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-hand-holding-usd"></i>
                        </span>
                        {!! Form::select('shipping_method', getShippingMethod(), Config::get('cms.shipping_method'),
                        ['class' => 'form-select']) !!}
                    </div>
                    <label for="products_per_page" class="mtop16">Monto mínimo para relizar el envio grátis</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-hand-holding-usd"></i>
                        </span>
                        {!! Form::number('shipping_ammount_min', Config::get('cms.shipping_ammount_min'), ['class' =>
                        'form-control', 'min' => 0, 'required']) !!}
                    </div>
                    <div class="col-md-4">
                        <label for="products_per_page" class="mtop16">Valor de envio</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fas fa-paper-plane"></i></i>
                            </span>
                            {!! Form::number('shipping_default_value', Config::get('cms.shipping_default_value'),
                            ['class'
                            => 'form-control', 'min' => 1, 'required']) !!}
                        </div>
                    </div>
                    <label for="to_go" class="mtop16">Ordenes TOGO
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-map-pin"></i>
                        </span>
                        {!! Form::select('to_go', getEnableOrNot(), Config::get('cms.to_go'), ['class' =>
                        'form-select']) !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- =============== --}}
        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-wifi"></i> Redes sociales</h2>
                </div>
                <div class="inside">
                    <label for="social_facebook">Facebbok</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fab fa-facebook-square"></i>
                        </span>
                        {!! Form::text('social_facebook', Config::get('cms.social_facebook'), ['class' =>
                        'form-control']) !!}
                    </div>
                    <label for="soacial_instagram" class="mtop16">Instagram</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fab fa-instagram"></i>
                        </span>
                        {!! Form::text('soacial_instagram', Config::get('cms.soacial_instagram'), ['class' =>
                        'form-control']) !!}
                    </div>
                    <label for="social_twitter" class="mtop16">Twitter</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fab fa-twitter"></i>
                        </span>
                        {!! Form::text('social_twitter', Config::get('cms.social_twitter'), ['class' =>
                        'form-control']) !!}
                    </div>
                    <label for="social_youtube" class="mtop16"> Youtube</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fab fa-youtube"></i>
                        </span>
                        {!! Form::text('social_youtube', Config::get('cms.social_youtube'), ['class' =>
                        'form-control']) !!}
                    </div>
                    <label for="social_whatsapp" class="mtop16">Whatsapp</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fab fa-whatsapp-square"></i>
                        </span>
                        {!! Form::text('social_whatsapp', Config::get('cms.social_whatsapp'), ['class' =>
                        'form-control']) !!}
                    </div>
                    <label for="social_tiktok" class="mtop16">Tik Tok</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fab fa-tiktok"></i>
                        </span>
                        {!! Form::text('social_tiktok', Config::get('cms.social_tiktok'), ['class' =>
                        'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  End row #1  --}}

    {{--  Row #2  --}}
    <div class="row mtop16">
        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-wallet"></i> Pago / Integraciones</h2>
                </div>
                <div class="inside">
                    <label for="payment_method_cash">Pagos en efectivo</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-cash-register"></i>
                        </span>
                        {!! Form::select('payment_method_cash', getEnableOrNot(), Config::get('cms.payment_method_cash'), ['class' =>
                        'form-select']) !!}
                    </div>

                    <label for="payment_method_transfer" class="mtop16">Transferencia / Deposito bamcaria
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-comment-dollar"></i>
                        </span>
                        {!! Form::select('payment_method_transfer', getEnableOrNot(), Config::get('cms.payment_method_transfer'), ['class' =>
                        'form-select']) !!}
                    </div>
                    <label for="payment_method_paypal" class="mtop16">Paypal
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fab fa-paypal"></i>
                        </span>
                        {!! Form::select('payment_method_paypal', getEnableOrNot(), Config::get('cms.payment_method_paypal'), ['class' =>
                        'form-select']) !!}
                    </div>
                    <label for="payment_method_credit_card" class="mtop16">Tarjeta de crédito
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-credit-card"></i>
                        </span>
                        {!! Form::select('payment_method_credit_card', getEnableOrNot(), Config::get('cms.payment_method_credit_card'), ['class' =>
                        'form-select']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-file"></i> Paginación</h2>
                </div>
                <div class="inside">
                    <label for="products_per_page">Productos a mostrar por página</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-eye"></i>
                        </span>
                        {!! Form::number('products_per_page', Config::get('cms.products_per_page'), ['class' =>
                        'form-control', 'min' => 1, 'required']) !!}
                    </div>
                    <label for="products_per_page_random" class="mtop16">Productos a mostrar por página (Random):
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-eye"></i>
                        </span>
                        {!! Form::number('products_per_page_random', Config::get('cms.products_per_page_random'),
                        ['class' => 'form-control', 'min' => 1, 'required']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fab fa-linux"></i> Servidor</h2>
                </div>
                <div class="inside">
                    <label for="server_uploads_path">Uploads server path</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-server"></i>
                        </span>
                        {!! Form::text('server_uploads_path', Config::get('cms.server_uploads_path'), ['class' =>
                        'form-control', 'required']) !!}
                    </div>
                    <label for="server_uploads_user_paths" class="mtop16">Uploads server users paths
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-server"></i>
                        </span>
                        {!! Form::text('server_uploads_user_paths', Config::get('cms.server_uploads_user_paths'),
                        ['class' => 'form-control', 'required']) !!}
                    </div>


                    <label for="server_webapp_path" class="mtop16">Path webapp
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-server"></i>
                        </span>
                        {!! Form::text('server_webapp_path', Config::get('cms.server_webapp_path'),
                        ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  End row #2  --}}

    <div class="row mtop16">
        <div class="col-md-12">
            <div class="panel shadow">
                <div class="inside">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}

                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}




</div>
@endsection
