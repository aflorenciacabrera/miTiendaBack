
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <div class="container">
    <br>
    <div class="card-columns">
     
        @foreach ( $galeria as $g)
       
        <div class="card" style="width: 18rem;">
            <div class="card-header">
             
                {{-- <img src=""  width="700" height="200" class="card-img-top" alt=""> --}}
               
            </div>
            <div class="card-body">

                <div class="card-body text-center">
                    <h5 class="card-title">{{$g}}</h5>
                   
                    <a href="#" class="btn btn-primary">Ver mas</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $galeria->links() }}

</div>