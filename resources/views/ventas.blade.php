@extends('root')
@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <h1>Generar una venta</h1>
            <hr>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Producto</label>
                        <select class="form-control" id="productosid">
                            <option></option>
                            @if(count($productos) > 0)
                                @for($a = 0; $a < count($productos); $a++)
                                    <option
                                        value="{{$productos[$a]['id']}}">{{$productos[$a]['nombre']}}</option>
                                @endfor
                            @endif

                        </select>
                    </div>
                    <button onClick="agregarproducto()" class="btn btn-primary btn-block">Agregar</button>
                </div>
                <div class="col-md-8">
                    <h1>Productos</h1>
                    <hr>
                    <form action="{{route('crearventa')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Usuario</label>
                            <select name="cliente" class="form-control" id="productosid" required>
                                <option></option>
                                @if(count($usuarios) > 0)
                                    @for($a = 0; $a < count($usuarios); $a++)
                                        <option
                                            value="{{$usuarios[$a]['id']}}">{{$usuarios[$a]['nombre']}}</option>
                                    @endfor
                                @endif

                            </select>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Precio U</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody id="cuerpoproductos">

                            </tbody>
                            <tr>
                                <th colspan="4"><h3>Total</h3></th>
                                <th><p id="valortotal"></p></th>
                            </tr>
                        </table>
                        <input type="submit" value="Generar venta" class="btn btn-primaty btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    let lista = []
    let pedido = [];

    let calc = function calculo() {
        let lugar = this.getAttribute('item');
        let precio = this.getAttribute('precio');
        let cantidadl = this.getAttribute('cantmax');
        console.log(this.value + ' ' + cantidadl);
        if (parseInt(this.value) <= cantidadl) {
            let subtotal = precio * this.value;
            document.getElementById('total' + lugar).innerText = '$' + subtotal;
        } else {
            document.getElementById('total' + lugar).innerText = 'Fuera de stock';
        }
    }

    function agregarproducto() {
        let flag = false;
        let id = document.getElementById("productosid").value;

        if (lista.length > 0) {
            for (let b = 0; b < lista.length; b++) {
                if (lista[b] == id) {
                    flag = true;
                }
            }
        }

        if (flag != true) {
            lista.push(id);
            fetch('/productos/bucar/' + id).then(res => res.json())
                .catch(error => console.error('Error:', error))
                .then(response => {
                    elChild = document.createElement('tr');
                    elChild.innerHTML = '<th scope="row"> <input type="hidden" name="producto[id][]" value="' + response[0]['id'] + '"><input type="hidden" name="producto[nombre][]" value="' + response[0]['nombre'] + '"><input type="hidden" name="producto[stock][]" value="' + response[0]['cantidad'] + '"><input type="hidden" name="producto[valorunidad][]" value="' + response[0]['precio'] + '">' + response[0]['nombre'] + '</th><td><input type="text" name="producto[cantidad][]" id="id' + response[0]['id'] + '" item="' + response[0]['id'] + '"  precio="' + response[0]['precio'] + '" cantmax="' + response[0]['cantidad'] + '" placeholder="' + response[0]['cantidad'] + '" required></td><td>' + response[0]['proveedor']['nombreproveedor'] + '</td><td>$' + response[0]['precio'] + '</td><td><p id="total' + response[0]['id'] + '"></p></td>'
                    document.getElementById('cuerpoproductos').appendChild(elChild);
                    document.getElementById('id' + response[0]['id']).addEventListener('keyup', calc);
                });
        }
    }

</script>
