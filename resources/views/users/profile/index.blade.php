@extends('layouts.app')

@section('title', 'Profile Index')
    
@section('content')
<body class="bg-light">

  {{-- Owner's view --}}
  <div class="row">
    <div class="col-4 p-3 d-flex justify-content-center align-items-center">
      <img src="{{ asset('storage/Image.png') }}" class="img-thumbnail rounded-circle avatar-lg">
    </div>
    <div class="col-8 p-5">
      <h2 class="display-6 mb-0">Fredy Mercury</h2><br>
      <button type="button" class="text-danger btn btn-lg" data-bs-toggle="modal" data-bs-target="#reacted-profile">
        <i class="fa-solid fa-heart text-danger"></i>
      </button>
      <button type="button" class="text-primary btn btn-lg" data-bs-toggle="modal" data-bs-target="#reacting-profile">
        <i class="fa-solid fa-heart"></i>
      </button>
    </div>
    @include('users.profile.modal.compatibility')
  </div>
  <div class="row mx-2">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut provident a suscipit delectus, minima, totam, autem reiciendis voluptates fugiat excepturi amet exercitationem nemo unde fugit explicabo. Error libero inventore, ab est obcaecati architecto aspernatur ex labore, vero amet ut placeat maxime. Eligendi, asperiores quo magni culpa exercitationem facilis? Porro, culpa! Perspiciatis iure eos magnam, soluta harum aliquam corporis temporibus dolorem sunt accusamus corrupti repellat expedita asperiores itaque. Ut aperiam alias accusantium, velit voluptates rem exercitationem delectus quidem voluptatem? Fuga dolores eveniet molestiae recusandae, quam a placeat ad eaque dicta, delectus non exercitationem. Suscipit temporibus commodi vitae eaque numquam cum corrupti?</p>
  </div>
  <div class="row mx-2">
    <div class="col d-flex">
      <div class="badge bg-turquoise fs-6 me-2 px-4">
        Design
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-center mx-3 mt-4">
    <h2>My Post</h2>
    <h4><a href="#" class="text-end">See more</a></h4>
  </div>
  <div class="bg-pink mx-2">
    <div class="row">
      <div class="col-3">
        <div class="container bg-white m-3">
          <div class="row">
            <div class="col-5 d-flex justify-content-center mt-2">
              <p class="mb-0">Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="col-7 d-flex justify-content-center mt-2">
              <img src="{{ asset('storage/Rectangle 84.png') }}" class="d-block w-100" style="height: auto;">
            </div>
          </div>          
          <div class="row">
            <div class="col d-flex align-items-center">
              <div class="badge bg-turquoise me-1">Animal</div>
              <a href="#" class="text-decoration-none ms-auto">see all reactions</a>
            </div>
          </div>
          <hr class="mx-auto">
          <div class="row">
            <div class="col d-flex align-items-center mb-2">
              <p class="mb-0 me-1" style="font-size: 0.8rem;">93%</p>
              <a href="#" class="me-2 d-flex align-items-center text-decoration-none text-black">
                  <i class="fa-solid fa-circle-user xsmall"></i>
                  <span class="fw-bold ms-1" style="font-size: 0.8rem;">Tim Simpson</span>
              </a>
              <p class="mb-0 me-1" style="font-size: 0.8rem;">How Cute!</p>
              <p class="mb-0 text-muted ms-auto xsmall">Aug.18.2024</p>
            </div>   
          </div>     
        </div>
      </div>
    </div>
  </div>

  <h2 class="mx-3 mt-4">Community</h2>
  <div class="d-flex justify-content-between align-items-center mx-4">
    <h3>Owner Community</h3>
    <h4><a href="#" class="text-end">See more</a></h4>
  </div>
  <div class="bg-blue mx-2">
    <div class="row">
      <div class="col-3">
        <div class="container bg-white m-3 p-0">
          <a href="#" class="d-block">
            <img src="{{ asset('storage/pexels-belle-co-99483-1000445 1.png') }}" class="w-100" style="height: auto;">
          </a>        
          <div class="row mt-2 mx-auto">
            <div class="col">
              <h5><a href="#" class="text-black fw-bold">Community title</a></h5>
              <p class="text-end">
                Created by
                <a href="#" class="ms-2">
                  <img src="{{ asset('storage/Image.png') }}" class="rounded-circle avatar-sm">
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-between align-items-center mx-4 mt-2">
    <h3>Join Community</h3>
    <h4><a href="#" class="text-end">See more</a></h4>
  </div>
  <div class="bg-blue mx-2">
    <div class="row">
      <div class="col-3">
        <div class="container bg-white m-3 p-0">
          <a href="#" class="d-block">
            <img src="{{ asset('storage/depositphotos_196912238-stock-photo-volunteers-holding-each-other 1.png') }}" class="w-100" style="height: auto;">
          </a>   
          <div class="row mt-2 mx-auto">
            <div class="col d-flex align-items-center">     
              <h5><a href="#" class="text-black fw-bold">Community title</a></h5>
            </div>
            <p class="text-end">
              Created by
              <a href="#" class="text-black ms-2">
                <i class="fa-solid fa-circle-user icon-sm"></i>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h2 class="mx-3 mt-4">Event</h2>
  <div class="d-flex justify-content-between align-items-center mx-4">
    <h3>Owner Event</h3>
    <h4><a href="#" class="text-end">See more</a></h4>
  </div>
  <div class="bg-yellow mx-2">
    <div class="row">
      <div class="col-3">
        <div class="container bg-white m-3 p-0">
          <a href="#" class="d-block">
            <img src="{{ asset('storage/2faac4315dbf39cf6e169f033cad1370_m 1.png') }}" class="w-100" style="height: auto;">
          </a>        
          <div class="row mt-2 mx-auto">
            <div class="col d-flex align-items-center">
              <h5 class="mb-1 me-3"><a href="#" class="text-black fw-bold">Event title</a></h5>
              <a href="#" class="text-black align-self-center">Community title</a>
            </div>
            <p class="text-end">
              Created by
              <a href="#" class="ms-2">
                <img src="{{ asset('storage/Image.png') }}" class="rounded-circle avatar-sm">
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-between align-items-center mx-4 mt-2">
    <h3>Join Event</h3>
    <h4><a href="#" class="text-end">See more</a></h4>
  </div>
  <div class="bg-yellow mx-2">
    <div class="row">
      <div class="col-3">
        <div class="container bg-white m-3 p-0">
          <a href="#" class="d-block">
            <img src="{{ asset('storage/2faac4315dbf39cf6e169f033cad1370_m 1 (1).png') }}" class="w-100" style="height: auto;">
          </a>        
          <div class="row mt-2 mx-auto">
            <div class="col d-flex align-items-center">
              <h5 class="mb-1 me-3"><a href="#" class="text-black fw-bold">Event title</a></h5>
              <a href="#" class="text-black align-self-center">Community title</a>
            </div>
            <p class="text-end">
              Created by
              <a href="#" class="text-black ms-2">
                <i class="fa-solid fa-circle-user icon-sm"></i>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div> 

  {{-- Other user's view --}}
  <div class="row">
    <div class="col-4 p-3 d-flex justify-content-center align-items-center">
      <img src="{{ asset('storage/Untitled design (2) 1.png') }}" class="img-thumbnail rounded-circle avatar-lg">
    </div>
    <div class="col-8 p-5">
      <h2 class="display-6 mb-0">Maria Konnno</h2><br>
      <button type="button" class="text-danger btn btn-lg" data-bs-toggle="modal" data-bs-target="#reacted-profile">
        <i class="fa-solid fa-heart text-danger"></i>
      </button>
      <button type="button" class="text-primary btn btn-lg" data-bs-toggle="modal" data-bs-target="#reacting-profile">
        <i class="fa-solid fa-heart"></i>
      </button>
      <div class="d-flex justify-content-end">
        <form action="#" method="post" class="d-flex">
          @csrf

          <div class="input-group me-2">
            <input type="number" name="compatibility" class="form-control" placeholder="Compatibility">
            <span class="input-group-text text-turquoise">%</span>
          </div>        
          <button type="submit" class="btn bg-gold text-white">send</button>
        </form>
      </div>    
    </div>
  </div>
  <div class="row mx-2">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut provident a suscipit delectus, minima, totam, autem reiciendis voluptates fugiat excepturi amet exercitationem nemo unde fugit explicabo. Error libero inventore, ab est obcaecati architecto aspernatur ex labore, vero amet ut placeat maxime. Eligendi, asperiores quo magni culpa exercitationem facilis? Porro, culpa! Perspiciatis iure eos magnam, soluta harum aliquam corporis temporibus dolorem sunt accusamus corrupti repellat expedita asperiores itaque. Ut aperiam alias accusantium, velit voluptates rem exercitationem delectus quidem voluptatem? Fuga dolores eveniet molestiae recusandae, quam a placeat ad eaque dicta, delectus non exercitationem. Suscipit temporibus commodi vitae eaque numquam cum corrupti?</p>
  </div>
  <div class="row mx-2">
    <div class="col d-flex">
      <div class="badge bg-turquoise fs-6 me-2 px-4">
        Movie
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-center mx-3 mt-4">
    <h2>Post</h2>
    <h4><a href="#" class="text-end">See more</a></h4>
  </div>
  <div class="bg-pink mx-2">
    <div class="row">
      <div class="col-3">
        <div class="container bg-white m-3">
          <div class="row">
            <div class="col-5 d-flex justify-content-center mt-2">
              <p class="mb-0">Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="col-7 d-flex justify-content-center mt-2">
              <img src="{{ asset('storage/pancake.png') }}" class="d-block w-100" style="height: auto;">
            </div>
          </div>          
          <div class="row">
            <div class="col d-flex align-items-center">
              <div class="badge bg-turquoise me-1">Sweets</div>
              <div class="badge bg-turquoise me-1">Cafe</div>
              <a href="#" class="text-decoration-none ms-auto">see all reactions</a>
            </div>
          </div>
          <hr class="mx-auto">
          <div class="d-flex">
            <form action="#" method="post">
              @csrf
    
              <div class="row gx-2">
                <div class="col-8">
                  <label for="empathy" class="form-label">empathy</label>
                  <div class="input-group">
                    <input type="number" name="empathy" id="empathy" class="form-control">
                    <span class="input-group-text text-turquoise">%</span>
                  </div>
                </div>
                <div class="col-4 d-flex align-items-end">
                  <button type="submit" class="btn bg-gold text-white text-center w-100">send</button>
                </div>
              </div>
              <label for="comment" class="form-label mt-1">comment</label>
              <input type="text" name="comment" id="comment" class="form-control mb-2"> 
            </form>
          </div>        
        </div>
      </div>
    </div>
  </div>

  <h2 class="mx-3 mt-4">Community</h2>
  <div class="d-flex justify-content-between align-items-center mx-4">
    <h3>Owner Community</h3>
    <h4><a href="#" class="text-end">See more</a></h4>
  </div>
  <div class="bg-blue mx-2">
    <div class="row">
      <div class="col-3">
        <div class="container bg-white m-3 p-0">
          <a href="#" class="d-block">
            <img src="{{ asset('storage/depositphotos_196912238-stock-photo-volunteers-holding-each-other 2.png') }}" class="w-100" style="height: auto;">
          </a>        
          <div class="row mt-2 mx-auto">
            <div class="col">
              <h5><a href="#" class="text-black fw-bold">Community title</a></h5>
              <p class="text-end">
                Created by
                <a href="#" class="ms-2">
                  <img src="{{ asset('storage/Untitled design (2) 1.png') }}" class="rounded-circle avatar-sm">
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-between align-items-center mx-4 mt-2">
    <h3>Join Community</h3>
    <h4><a href="#" class="text-end">See more</a></h4>
  </div>
  <div class="bg-blue mx-2">
    <div class="row">
      <div class="col-3">
        <div class="container bg-white m-3 p-0">
          <a href="#" class="d-block">
            <img src="{{ asset('storage/depositphotos_196912238-stock-photo-volunteers-holding-each-other 1 2.png') }}" class="w-100" style="height: auto;">
          </a>   
          <div class="row mt-2 mx-auto">
            <div class="col d-flex align-items-center">     
              <h5><a href="#" class="text-black fw-bold">Community title</a></h5>
            </div>
            <p class="text-end">
              Created by
              <a href="#" class="text-black ms-2">
                <i class="fa-solid fa-circle-user icon-sm"></i>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h2 class="mx-3 mt-4">Event</h2>
  <div class="d-flex justify-content-between align-items-center mx-4">
    <h3>Owner Event</h3>
    <h4><a href="#" class="text-end">See more</a></h4>
  </div>
  <div class="bg-yellow mx-2">
    <div class="row">
      <div class="col-3">
        <div class="container bg-white m-3 p-0">
          <a href="#" class="d-block">
            <img src="{{ asset('storage/sushiparty.png') }}" class="w-100" style="height: auto;">
          </a>        
          <div class="row mt-2 mx-auto">
            <div class="col d-flex align-items-center">
              <h5 class="mb-1 me-3"><a href="#" class="text-black fw-bold">Event title</a></h5>
              <a href="#" class="text-black align-self-center">Community title</a>
            </div>
            <p class="text-end">
              Created by
              <a href="#" class="ms-2">
                <img src="{{ asset('storage/Untitled design (2) 1.png') }}" class="rounded-circle avatar-sm">
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-between align-items-center mx-4 mt-2">
    <h3>Join Event</h3>
    <h4><a href="#" class="text-end">See more</a></h4>
  </div>
  <div class="bg-yellow mx-2">
    <div class="row">
      <div class="col-3">
        <div class="container bg-white m-3 p-0">
          <a href="#" class="d-block">
            <img src="{{ asset('storage/live.png') }}" class="w-100" style="height: auto;">
          </a>        
          <div class="row mt-2 mx-auto">
            <div class="col d-flex align-items-center">
              <h5 class="mb-1 me-3"><a href="#" class="text-black fw-bold">Event title</a></h5>
              <a href="#" class="text-black align-self-center">Community title</a>
            </div>
            <p class="text-end">
              Created by
              <a href="#" class="text-black ms-2">
                <i class="fa-solid fa-circle-user icon-sm"></i>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>  
</body>
@endsection