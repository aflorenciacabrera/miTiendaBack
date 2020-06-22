

  <div class="container">
    <br>
    <div class="card-columns">
      $galeria
        @foreach ( $galeria as $g)
        {{$g}}
        <div class="card" style="width: 18rem;">
            <div class="card-header">
             
                {{-- <img src=""  width="700" height="200" class="card-img-top" alt=""> --}}
                <img src="{{ asset('images/' . $image->getFilename()) }}" width="200" height="200" class="card-img-top" alt="">
            </div>
            <div class="card-body">

                {{-- <div class="card-body text-center">
                    <h5 class="card-title">{{p.titulo}}</h5>
                    <p class="card-text">{{p.precio}}</p>
                    <p class="card-text">{{p.descripcion}}</p>
                    <a href="#" class="btn btn-primary">Ver mas</a>
                </div> --}}
            </div>
        </div>
        @endforeach
    </div>



</div>