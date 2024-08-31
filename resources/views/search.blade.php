@extends('layouts.app')

@section('title', 'Search')

@section('content')


<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<div class="container-fluid search-bg" >
     <h1 class="fw-bold text-center ">Your Key word is...""</h1>



{{-- User --}}
<div class="mt-5">
        <h2 class="mx-3">User</h2>
        <p class=" h5 text-end text-decoration-underline text-primary"><a href="#"></a>see more</p>
        <div class="container-fluid  green p-2">

            <table >

                <tr　>
                    <td><img src="https://thumb.ac-illust.com/a9/a98d75082e21d9918023a6eeb5a5cd59_t.jpeg" alt="" class="search-img"></td>
                    <td><img src="https://thumb.ac-illust.com/a9/a98d75082e21d9918023a6eeb5a5cd59_t.jpeg" alt="" class="search-img"></td>
                    <td><img src="https://thumb.ac-illust.com/a9/a98d75082e21d9918023a6eeb5a5cd59_t.jpeg" alt="" class="search-img"></td>
                    <td><img src="https://thumb.ac-illust.com/a9/a98d75082e21d9918023a6eeb5a5cd59_t.jpeg" alt="" class="search-img"></td>
                    <td><img src="https://thumb.ac-illust.com/a9/a98d75082e21d9918023a6eeb5a5cd59_t.jpeg" alt="" class="search-img"></td>

                </tr>


              </table>
        {{-- </div> --}}
    </div>
    </div>
{{-- Post --}}
<div class="mt-5">
        <h2 class="mx-3">Post</h2>
        <p class="h5 text-end text-decoration-underline text-primary"><a href="#"></a>see more</p>
        <div class="container-fluid bg-pink p-2">
                 <table >

                    <tr>
                      <td><img src="https://img.freepik.com/free-vector/flat-design-tweet-mockup_23-2149200431.jpg?size=338&ext=jpg&ga=GA1.1.2008272138.1724803200&semt=ais_hybrid" alt="" class="search-img"></td>
                    </tr>


                  </table>

        </div>
</div>

{{-- Community --}}
<div class="mt-5">
        <h2 class="mx-3">Community</h2>
        <p class="h5 text-end text-decoration-underline text-primary"><a href="#"></a>see more</p>
        <div class="container-fluid bg-blue p-2">
                 <table >


                    <tr>
                      <td><img src="https://st2.depositphotos.com/3591429/5246/i/450/depositphotos_52469139-stock-illustration-people-holding-placards-forming-community.jpg" alt="" class="search-img"></td>
                    </tr>


                  </table>

        </div>
</div>

{{-- Event --}}
      <div class="mt-5">
        <h2 class="mx-3">Event</h2>
        <p class="h5 text-end text-decoration-underline text-primary"><a href="#"></a>see more</p>
        <div class="container-fluid bg-yellow p-2">

                 <table >


                    <tr>
                      <td><img src="https://www.unreality.jp/wp-content/uploads/2019/03/live-concert-min-790x480.jpeg" alt="" class="search-img"></td>
                    </tr>


                  </table>

        </div>

 </div>






</div>

</div>
@endsection
