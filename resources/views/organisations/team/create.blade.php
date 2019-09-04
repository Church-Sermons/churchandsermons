@section('title', 'Add Member')

@extends('layouts.app')

@section('content')
<div id="safeguard">
    <div id="form">
        <div class="container form-inner my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold mb-3 text-center">Add Team Member</h2>
                            {{-- <p class="card-text text-center">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Voluptatem non, quasi aliquid corporis atque, asperiores
                                fuga impedit corrupti autem optio fugit modi accusamus ducimus
                                ut facere. Minus, expedita ut. Odit?
                            </p> --}}
                            <form action="{{ route('organisations.team.store', $organisation->uuid) }}"
                                method="post" enctype="multipart/form-data"
                                class="py-2" id="teamForm">
                                @csrf
                                @component('components.messages')@endcomponent
                                @component('organisations.team.form', ['categories' => $categories, 'oldCategory' => old('category')])
                                    @slot('name')
                                        {{ old('name') }}
                                    @endslot
                                    @slot('surname')
                                        {{ old('surname') }}
                                    @endslot
                                    @slot('email')
                                        {{ old('email') }}
                                    @endslot
                                    @slot('website')
                                        {{ old('website') }}
                                    @endslot
                                    @slot('phone')
                                        {{ old('phone') }}
                                    @endslot
                                    @slot('address')
                                        {{ old('address') }}
                                    @endslot
                                    @slot('latitude')
                                        {{ old('latitude') }}
                                    @endslot
                                    @slot('longitude')
                                        {{ old('longitude') }}
                                    @endslot
                                    @slot('description')
                                        {{ old('description') }}
                                    @endslot
                                    @slot('profile')
                                        {{ old('profile') }}
                                    @endslot
                                    @slot('submitButtonText')
                                        Add Member
                                    @endslot
                                @endcomponent
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @component('components.modal')
        @slot('title')
            Add Profile Category
        @endslot

        <div class="message-area"></div>

        <form action="#" method="post" id="categoryForm">
            @csrf
            @component('categories.form', [
                            'linked' => old('linked_to', 'profile'),
                            'links' => ['profile']])
                @slot('name')
                    {{ old('name') }}
                @endslot
                @slot('submitButtonText')
                    Add Category
                @endslot
            @endcomponent
        </form>
    @endcomponent
</div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // phone number add dashes
            const phone = document.getElementById('phone');


            // check value length on keyup
            phone.addEventListener('keyup', function(e){
                if(this.value.length >= 9){
                    const cleansedValue = this.value.replace(/\D[^\.]/g, "");
                    this.value = addDashes(cleansedValue, e);
                }

            });

            function addDashes(cv, e){
                // handling keys like del or backspace
                const key = e.which || e.keyCode || e.charCode;

                if(key != 8 && key != 46){
                    // create dashes
                    const firstPart = cv.slice(0,3);
                    const secondPart = cv.slice(3,6);
                    const thirdPart = cv.slice(6);

                    // return string combining all three parts
                    return `${firstPart}-${secondPart}-${thirdPart}`;
                }

                return;

            }

            /**
                <----------- Server Request To Create Categories On The Fly ----->

            **/

            // form
            const form = document.getElementById('categoryForm');


            form.addEventListener('submit', function(e){
                e.preventDefault();

                // get form data
                const formData = new FormData(e.target);

                if(formValidation(formData)){
                    // create data
                    const category = {
                        name: formData.get('name'),
                        linked_to: formData.get('linked_to')
                    };

                    submitCategory(category);
                }

            });

            // validate form data
            function formValidation(data){
                if(data.get('name') && data.get('linked_to')){
                    if(data.get('name').length <= 255){
                        return true;
                    }
                }
                return false;
            }

            // make request to server
            async function submitCategory(category){
                try {
                    const response = await axios.post('{{ route('categories.storejson') }}', category);
                    const { data } = response;

                    // display server message
                    const alertBox = `<div class='alert alert-${data.status} fade show'>${data.message}</div>`;
                    document.querySelector(".message-area").innerHTML = alertBox;

                    // reset form
                    form.reset();

                    // reload page
                    setTimeout(() => window.location.reload(), 3000);
                } catch (error) {
                    console.log(error);
                }
            }

            // Persist form data to avoid loss
            const teamForm = document.getElementById('teamForm');
            FormPersistence.persist(teamForm, {
                useSessionStorage: true,
                exclude: '_token'
            });

        });

    </script>
@endsection
