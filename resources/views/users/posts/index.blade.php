@extends('layouts.app')

@section('title', 'Post:index')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
    <div class="row" style="">
        <div class="col p-1">
                        {{-- Frame of 1 Post & It's going to be repeat--}}
                        <div class="card w-100 mb-1 bg-pink">
                            <div class="card-body">
                                {{-- post text --}}
                                <div class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt natus dolorum odit laudantium, vel expedita, commodi quidem veniam velit vitae sunt itaque fugit maxime! Eum ea iste necessitatibus inventore a!
                                </div>
                    
                                {{-- post image --}}
                                <div >
                                <img class="w-100" src="https://thumb.photo-ac.com/88/889961b60e2ae3a3360b18ef2229df6a_t.jpeg" alt="">
                                </div>
                    
                                {{-- post category --}}
                                <div class="row text-start">
                                    <div class="col">
                                        <span class="badge me-1 bg-turquoise text-white">Anime</span> 
                                        <span class="badge me-1 bg-turquoise text-white">Food</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        {{-- Just a example of other Post--}}
                        <div class="card w-100 mb-1 bg-pink">
                            <div class="card-body">
                                {{-- post text --}}
                                <div class="mb-3">
                                </div>
                    
                                {{-- post image --}}
                                <div >
                                <img class="w-100" src="https://thumb.photo-ac.com/88/889961b60e2ae3a3360b18ef2229df6a_t.jpeg" alt="">
                                </div>
                    
                                {{-- post category --}}
                                <div class="row">
                                    <div class="col text-end">
                                        <span class="badge me-1 bg-turquoise text-white">Anime</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
            
                         {{-- Just a example of other Post--}}
                         <div class="card w-100 mb-1 bg-pink">
                            <div class="card-body">
                                {{-- post text --}}
                                <div class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt natus dolorum odit laudantium, vel expedita, commodi quidem veniam velit vitae sunt itaque fugit maxime! Eum ea iste necessitatibus inventore a!
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique, voluptatem debitis ex deleniti sed sunt corrupti labore molestiae illo omnis dolore eos vero. Ad, nihil incidunt esse non quibusdam vero!
                                Iste harum perspiciatis doloremque corporis nemo, commodi, non hic cumque eos eius asperiores! Minus totam placeat assumenda suscipit consectetur deleniti aliquid? Consectetur fugiat eveniet dolores ab iste, nisi dolorem culpa?
                                Praesentium dicta laborum consequatur inventore hic veniam laboriosam perspiciatis libero corrupti aut minima, pariatur ea itaque omnis illum officiis obcaecati exercitationem voluptate voluptatem harum. Sed rerum unde repellendus minima enim!
                                Sit ea inventore provident delectus alias odit consequuntur consectetur pariatur hic, ut iusto quod nulla deleniti vitae omnis quaerat, voluptatum quidem, amet aliquam officiis illum distinctio nihil? Laudantium, ratione voluptas!
                                </div>
                    
                                {{-- post image --}}
                                <div >
                                <img class="w-100" src="" alt="">
                                </div>
                    
                                {{-- post category --}}
                                <div class="row">
                                    <div class="col text-end">
                                        <span class="badge me-1 bg-turquoise text-white">Anime</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        {{-- Just a example of other Post--}}
                        <div class="card w-100 mb-1 bg-pink">
                            <div class="card-body">
                                {{-- post text --}}
                                <div class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. </div>
                    
                                {{-- post image --}}
                                <div >
                                <img class="w-100" src="" alt="">
                                </div>
                    
                                {{-- post category --}}
                                <div class="row">
                                    <div class="col text-end">
                                        <span class="badge " style="background-color: #0D768B; text-color: white;">Anime</span> 
                                    </div>
                                </div>
                            </div>
                        </div>

        </div>
        <div class="col p-1">
            <div class="card w-100 mb-1 bg-pink">
                <div class="card-body">
                    {{-- post text --}}
                    <div class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt natus dolorum odit laudantium, vel expedita, commodi quidem veniam velit vitae sunt itaque fugit maxime! Eum ea iste necessitatibus inventore a!Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    </div>
        
                    {{-- post image --}}
                    <div >
                    <img class="w-100" src="https://thumb.photo-ac.com/88/889961b60e2ae3a3360b18ef2229df6a_t.jpeg" alt="">
                    </div>
        
                    {{-- post category --}}
                    <div class="row text-start">
                        <div class="col">
                            <span class="badge me-1 bg-turquoise text-white">Anime</span> 
                            <span class="badge me-1 bg-turquoise text-white">Food</span> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="card w-100 mb-1 bg-pink">
                <div class="card-body">
                    {{-- post text --}}
                    <div class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt natus dolorum odit laudantium, vel expedita, commodi quidem veniam velit vitae sunt itaque fugit maxime! Eum ea iste necessitatibus inventore a!Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    </div>
        
                    {{-- post image --}}
                    <div >
                    <img class="w-100" src="https://thumb.photo-ac.com/88/889961b60e2ae3a3360b18ef2229df6a_t.jpeg" alt="">
                    </div>
        
                    {{-- post category --}}
                    <div class="row text-start">
                        <div class="col">
                            <span class="badge me-1 bg-turquoise text-white">Anime</span> 
                            <span class="badge me-1 bg-turquoise text-white">Food</span> 
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col  p-1">
            <div class="card w-100 mb-1 bg-pink">
                <div class="card-body">
                    {{-- post text --}}
                    <div class="mb-3">
                    </div>
        
                    {{-- post image --}}
                    <div >
                    <img class="w-100" src="https://thumb.photo-ac.com/88/889961b60e2ae3a3360b18ef2229df6a_t.jpeg" alt="">
                    </div>
        
                    {{-- post category --}}
                    <div class="row text-start">
                        <div class="col">
                            <span class="badge me-1 bg-turquoise text-white">Anime</span> 
                            <span class="badge me-1 bg-turquoise text-white">Food</span> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="card w-100 mb-1 bg-pink">
                <div class="card-body">
                    {{-- post text --}}
                    <div class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt natus dolorum odit laudantium, vel expedita, commodi quidem veniam velit vitae sunt itaque fugit maxime! Eum ea iste necessitatibus inventore a!Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    </div>
        
                    {{-- post image --}}
                    <div >
                    <img class="w-100" src="https://thumb.photo-ac.com/88/889961b60e2ae3a3360b18ef2229df6a_t.jpeg" alt="">
                    </div>
        
                    {{-- post category --}}
                    <div class="row text-start">
                        <div class="col">
                            <span class="badge me-1 bg-turquoise text-white">Anime</span> 
                            <span class="badge me-1 bg-turquoise text-white">Food</span> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col  p-1">
            <div class="card w-100 mb-1 bg-pink">
                <div class="card-body">
                    {{-- post text --}}
                    <div class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt natus dolorum odit laudantium, vel expedita, commodi quidem veniam velit vitae sunt itaque fugit maxime! Eum ea iste necessitatibus inventore a!Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    </div>
        
                    {{-- post image --}}
                    <div >
                    <img class="w-100" src="https://thumb.photo-ac.com/88/889961b60e2ae3a3360b18ef2229df6a_t.jpeg" alt="">
                    </div>
        
                    {{-- post category --}}
                    <div class="row text-start">
                        <div class="col">
                            <span class="badge me-1 bg-turquoise text-white">Anime</span> 
                            <span class="badge me-1 bg-turquoise text-white">Food</span> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col  p-1">
            <div class="card w-100 mb-1 bg-pink">
                <div class="card-body">
                    {{-- post text --}}
                    <div class="mb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
        
                    {{-- post image --}}
                    <div >
                    <img class="w-100" src="https://thumb.photo-ac.com/88/889961b60e2ae3a3360b18ef2229df6a_t.jpeg" alt="">
                    </div>
        
                    {{-- post category --}}
                    <div class="row text-start">
                        <div class="col">
                            <span class="badge me-1 bg-turquoise text-white">Anime</span> 
                            <span class="badge me-1 bg-turquoise text-white">Food</span> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
