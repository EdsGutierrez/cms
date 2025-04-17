@extends('admin.master')

@section('title', 'Orden N°' . $order->o_number)
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/orders/all/all') }}"><i <i class="fa-solid fa-folder"></i> Ordenes</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#"><i class="fas fa-clipboard-list"></i> Orden N° {{ $order->o_number }} </a>
    </li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="order">
            <div class="row">
                <!-- Columna N°1 -->
                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-circle-user"></i> Ususario</h2>
                        </div>
                        <div class="inside">
                            <div class="profile">
                                <div class="photo">
                                    @if (is_null($order->getUser->avatar))
                                        <img src="{{ url('/static/images/default-avatar.png') }}"
                                            class="img-fluid rounded-circle">
                                    @else
                                        <img src="{{ url('/uploads_users/' . $order->getUser->id . '/' . $order->getUser->avatar) }}"
                                            class="img-fluid rounded-circle">
                                    @endif
                                </div>
                                <div class="info mtop16">
                                    <ul>
                                        <li><i class="fa-solid fa-user-tie"></i> <strong>Nombre: </strong>
                                            {{ $order->getUser->name . ' ' . $order->getUser->lastname }} </li>
                                        <li><i class="fa-solid fa-at"></i> <strong>E-mail: </strong>
                                            {{ $order->getUser->email }} </li>
                                        @if ($order->getUser->phone)
                                            <li><i class="fa-solid fa-phone"></i> <strong>Telefono: </strong>
                                                {{ $order->getUser->phone }} </li>
                                        @endif
                                    </ul>
                                    <a href="{{ url('/admin/user/' . $order->user_id . '/view') }}" class="btn btn-primary">
                                        Ver
                                        usuario</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel shadow mtop16">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-circle-user"></i> Tipo de orden</h2>
                        </div>
                        <div class="inside">
                            @if ($order->o_type == '0')
                                <p style="margin-bottom: 2px;"><strong>Estado:
                                    </strong>{{ $order->getUserAddress->getState->name }}</p>
                                <p style="margin-bottom: 2px;"><strong>Ciudad:
                                    </strong>{{ $order->getUserAddress->getCity->name }}</p>

                                <p style="margin-bottom: 2px;"><strong>Dirección:
                                    </strong>{{ kvfj($order->getUserAddress->addr_info, 'add1') }},
                                    {{ kvfj($order->getUserAddress->addr_info, 'add2') }},
                                    {{ kvfj($order->getUserAddress->addr_info, 'add3') }}.</p>

                                <p style="margin-bottom: 2px;"><strong>Referencia:
                                    </strong>{{ kvfj($order->getUserAddress->addr_info, 'add4') }}</p>
                            @endif
                            <div class="edswitch">
                                <a href="#" class="sl @if ($order->o_type == ' 0') active @endif">
                                    <i class="fas fa-motorcycle"></i> Domicilio
                                </a>

                                <a href="#" class="sl @if ($order->o_type == ' 1') active @endif">
                                    <i class="fas fa-car-side"></i> TO GO
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin de la Columna N°1 -->










                <!-- Columna N°2 -->
                <div class="col-md-6">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-clipboard-list"></i> Listado de ordenes</h2>
                        </div>
                        <div class="inside">
                            <table class="table table-striped align-middle table-hover">
                                <thead>
                                    <tr>
                                        <td width="64"></td>
                                        <td><strong>Producto</strong></td>
                                        <td width="120"><strong>Cantidad</strong></td>
                                        <td width="124"><strong>Subtotal</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->getItems as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ url('/uploads/' . $item->getProduct->file_path . '/t_' . $item->getProduct->image) }}"
                                                    class="img-fluid rounded">
                                            </td>
                                            <td><a
                                                    href="{{ url('/product/' . $item->getProduct->id . '/' . $item->getProduct->slug) }}">
                                                    {{ $item->label_item }}
                                                    <div class="price_discount">
                                                        Precio:
                                                        @if ($item->discount_status == '1')
                                                            <span
                                                                class="price_initial">{{ config('cms.currency') . ' ' . number_format($item->price_initial, 2, '.', ',') }}
                                                            </span> /
                                                        @endif
                                                        <span
                                                            class="price_unita">{{ config('cms.currency') . ' ' . number_format($item->price_unit, 2, '.', ',') }}
                                                            @if ($item->discount_status == '1')
                                                                ({{ $item->discount }}% de
                                                                descuento)
                                                            @endif
                                                        </span>
                                                    </div>
                                                </a></td>

                                            <td>{{ $item->quantity }}</td>
                                            <td>
                                                <strong>{{ number($item->total) }}</strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><strong>Subtotal: </strong></td>
                                        <td><strong>{{ number($order->getSubTotal()) }} </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><strong>Precio de envío: </strong></td>
                                        <td><strong>{{ number($order->delivery) }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><strong>Total de la orden: </strong></td>
                                        <td><strong>{{ number($order->total) }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            @if (kvfj(Auth::user()->permissions, 'orders_change_status'))
                                <div class="order_status mtop16">
                                    @if ($order->status == '6' || $order->status == '100')
                                        {!! Form::open(['url' => '#', 'disabled']) !!}
                                    @else
                                        {!! Form::open(['url' => '/admin/order/' . $order->id . '/view']) !!}
                                    @endif

                                    <div class="row">
                                        <div class="col-md-12"><strong>Estado de la orden:</strong></div>
                                    </div>
                                    <div class="row">
                                        <div class="col md-5">
                                            @if ($order->o_type == '0')
                                                {!! Form::select('status', Arr::except(getorderStatus(), ['0', '5']), $order->status, [
                                                    'class' => 'form-select',
                                                ]) !!}
                                            @else
                                                {!! Form::select('status', Arr::except(getorderStatus(), ['0', '4']), $order->status, [
                                                    'class' => 'form-select',
                                                ]) !!}
                                            @endif

                                        </div>
                                        <div class="col-md-4">
                                            @if ($order->status == '6' || $order->status == '100')
                                            {!! Form::submit('Actualizar', ['class' => 'btn btn-success w-100', 'disabled']) !!}
                                            @else
                                            {!! Form::submit('Actualizar', ['class' => 'btn btn-success w-100']) !!}
                                            @endif

                                            
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Fin de la Columna N°2 -->









                <!-- Columna N°3 -->
                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-credit-card"></i> Métodos de pago</h2>
                        </div>
                        <div class="inside">
                            <div class="payments_methods">
                                <a href="#" class="w-100 active" id="payment_method_cash" data-payment-method-id="0">
                                    <i class="fas fa-cash-register"></i>
                                    {{ getPaymentsMethods($order->payment_method) }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="panel mtop16 shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-calendar"></i> Actividad</h2>
                        </div>
                        <div class="inside">
                            <div class="profile">
                                <div class="info">
                                    <ul>
                                        <li><i class="fa-regular fa-clock"></i><strong> Requerido: </strong>
                                            {{ $order->request_at }} </li>
                                        <li><i class="fa-regular fa-credit-card"></i><strong> Pagado: </strong>
                                            {{ $order->paid_at }} </li>
                                        <li><i class="fa-solid fa-spinner"></i><strong> Procesando: </strong>
                                            {{ $order->process_at }} </li>
                                        @if ($order->o_type == '0')
                                            <li><i class="fa-regular fa-paper-plane"></i><strong> Enviada: </strong>
                                                {{ $order->send_at }} </li>
                                        @else
                                            <li><i class="fa-regular fa-hand-point-right"></i><strong> Lista: </strong>
                                                {{ $order->send_at }} </li>
                                        @endif
                                        <li><i class="fa-regular fa-folder"></i><strong> Entragado: </strong>
                                            {{ $order->delivery_at }} </li>

                                        @if ($order->rejected_at)
                                            <li><i class="fa-regular fa-hand" style="color: #f20202;"></i></i><strong>
                                                    Rechazado: </strong>
                                                {{ $order->rejected_at }} </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel mtop16 shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-envelope-open"></i> Más</h2>
                        </div>
                        <div class="inside">
                            <label for="order_msg"> Comentario:</label>
                            @if ($order->user_comment)
                                <p>{!! $order->user_comment !!}</p>
                            @endif
                        </div>
                    </div>

                </div>
                <!-- Fin de la Columna N°3 -->
            </div>
        </div>
    </div>



@endsection
