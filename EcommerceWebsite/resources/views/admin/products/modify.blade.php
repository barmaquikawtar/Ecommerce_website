<x-app-layout>
    <style>

    </style>
    <div class="container-fluid">
        <div class="row">
            <x-admin.sidenavbar/>
            <form method="post" action="{{'/admin/modifyproduct/'.$product->id}}" enctype="multipart/form-data"
                  class="container-fluid col-10 my-5">
                @csrf
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="font-semibold text-xl mb-0 text-gray leading-tight align-items-center"
                        style="font-size:30px;color: #204f8c">
                        {{ __('Modifier produit') }}
                    </h2>
                    <a href="{{url('/admin/products')}}" class="btn ps-5 pe-5 text-light"
                       style="background-color: #204f8c;border-radius: 0">
                        Retour
                    </a>
                </div>
                <div class="row align-items-center">
                    <div class="col-4 col-sm-4 col-md-2 col-lg-1 mt-4">
                        <x-label for="title" :value="__('Titre')"/>
                    </div>
                    <div class="col-8 col-md-4 col-lg-3 mt-4">
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                 value="{{$product->title}}"
                                 required autofocus/>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-1 mt-4">
                        <x-label for="Etat" :value="__('Etat')"/>
                    </div>
                    <div class="col-8 col-md-4 col-lg-3 mt-4">
                        <select name="Etat" id="Etat" class="form-control">
                            <option value="Neuf" @if($product->statut=='Neuf') selected @endif>Neuf</option>
                            <option value="Occasion" @if($product->statut=='Occasion') selected @endif>Occasion</option>
                        </select>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-1 mt-4">
                        <x-label for="company" :value="__('Companie')"/>
                    </div>
                    <div class="col-8 col-md-4 col-lg-3 mt-4">
                        <select id="company" name="company" value="old('company')" required class="form-control">
                            @foreach($companies as $company)
                                <option value="{{$company->id}}"
                                        @if($product->company_id==$company->id) selected @endif>
                                    {{$company->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-1 mt-4">
                        <x-label for="category" :value="__('Categorie')"/>
                    </div>
                    <div class="col-8 col-md-4 col-lg-3 mt-4">
                        <select name="category" id="category" class="form-control">
                            @foreach($categoris as $category)
                                <option value="{{$category->id}}"
                                        @if($product->childcategory->category_id==$category->id) selected @endif>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-1 mt-4">
                        <x-label for="childcategory" :value="__('Sous Categorie')"/>
                    </div>
                    <div class="col-8 col-md-4 col-lg-3 mt-4">
                        <select id="childcategory" name="childcategory" required class="form-control">
                            @foreach($childcategoris as $childcategory)
                                <option value="{{$childcategory->id}}"
                                        @if($product->child_category_id==$childcategory->id) selected @endif>
                                    {{$childcategory->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-1 mt-4">
                        <x-label for="price" :value="__('Pirx')"/>
                    </div>
                    <div class="col-8 col-md-4 col-lg-3 mt-4">
                        <input type="text" id="price" name="price" required
                               class="form-control" value="{{$product->price}}"/>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-1 mt-4">
                        <x-label for="Quantite" :value="__('Quantite')"/>
                    </div>
                    <div class="col-8 col-md-4 col-lg-3 mt-4">
                        <input type="number" min="0" id="Quantite" name="Quantite" value="{{$product->quantity}}"
                               required
                               class="form-control"/>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-1 mt-4">
                        <x-label for="colors" :value="__('Coleurs')"/>
                    </div>
                    <div class="col-8 col-md-4 col-lg-3 mt-4 d-flex align-items-center flex-wrap">
                        <input type="hidden" name="selectedcolors" id="selectedcolors"
                               value="@foreach($product->colors as $color){{$color->name.'|'}}@endforeach">
                        <input type="color" min="0" id="colors" name="colors" value="{{old('colors')}}" required/>
                        <img class="ms-3 addcolor" src="{{asset('media/icons/add.svg')}}"
                             style="height: 25px;cursor: pointer"/>
                        <div class="colorarea d-flex flex-wrap ms-3"></div>
                        <div class="d-flex">
                            @foreach($product->colors as $color)
                                <span color="{{$color->name}}"
                                      style="border-radius:100px;height: 23px;width: 23px;background-color: {{$color->name}}"></span>
                                <img class="deletecolor me-2" color="{{$color->name}}"
                                     style="height:25px;cursor:pointer" src="{{asset('media/icons/remove.svg')}} ">
                            @endforeach
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-1 mt-4">
                        <x-label for="images" :value="__('Images')"/>
                    </div>
                    <div class="col-8 col-md-4 col-lg-3 mt-4 ">
                        <input type="file" class="form-control" name="images[]" id="images" multiple="multiple">
                        <div class="d-flex">
                            @foreach($product->images as $image)
                                <img src="{{asset('storage/products/'.$image->name)}}" style="height: 30px"
                                     class="img-fluid">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 mt-4">
                        <x-label for="presentation" :value="__('Presentation')"/>
                    </div>
                    <div class="col-11 mt-4">
                         <textarea id="presentation" name="presentation">
                            {{$product->presentation}}
                        </textarea>
                    </div>
                    <div class="col-1 mt-4">
                        <x-label for="Description" :value="__('Description')"/>
                    </div>
                    <div class="col-11 mt-4">
                        <textarea id="Description" name="Description">
{{$product->specification}}
                        </textarea>
                    </div>
                    <div class="col-1 mt-4">
                        <x-label for="technicalfile" :value="__('Fiche technique')"/>
                    </div>
                    <div class="col-11 mt-4">
                        <textarea id="technicalfile" name="technicalfile">
{{$product->Technical_sheet}}
                        </textarea>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-4">
                        <x-button class="ml-3 ms-0 " style="background-color: #204f8c ;border-radius: 0">
                            {{ __('Enregistrer') }}
                        </x-button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.addcolor').click(function () {
                $('.colorarea').append('<span color="' + $('#colors').val() + '" class="me-2 " style="border-radius:100px;height:23px;width:44px;background-color:' + $('#colors').val() + '"></span><img class="deletecolor me-2" color="' + $('#colors').val() + '" style="height:25px;cursor:pointer" src="{{asset('media/icons/remove.svg')}} ">')
                $('#selectedcolors').val(function () {
                    return $(this).val() + $('#colors').val() + '|'
                })
            })
            $(document).on('click', '.deletecolor', function () {
                $colorcode = $(this).attr("color")
                $("span[color='" + $colorcode + "']").hide()
                $("img[color='" + $colorcode + "']").hide()
                $('#selectedcolors').val(function () {
                    $newvalue = $(this).val().split($colorcode + '|').join('')
                    return $newvalue
                })

            })
            $('#category').change(function () {
                $category_id = $(this).val()
                $.ajax({
                    url: '/admin/filtercategory',
                    type: 'POST',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'category_id': $category_id
                    },
                    success: function (e) {
                        $('#childcategory').html('')
                        for (i = 0; i < e.length; i++) {
                            $('#childcategory').append('<option class="me-2" value="' + e[i].id + '">' + e[i].name + '</option>')
                        }
                    }, error: function (e) {

                    }
                })
            })
        })
        ClassicEditor
            .create(document.querySelector('#technicalfile'),{
                mediaEmbed: {previewsInData: true}
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#Description'),{
                mediaEmbed: {previewsInData: true}

            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#presentation'),{
                mediaEmbed: {previewsInData: true}
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>
