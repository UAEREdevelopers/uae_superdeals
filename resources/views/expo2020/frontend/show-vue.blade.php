<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expo2020 Deals at Superdeals</title>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="{{ asset('js/vue.js') }}"></script>
</head>

<body>

    <div id="content" >
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card text-center" style="max-width: 38rem;">
                        <div class="card-header text-white bg-success">
                            Expo 2020 Packages
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="dayselect">Select Nights</label>
                            <select name="days" class="form-control" id="dayselect" v-model="selectedDay" @change="CalculatePrice">
                                <option v-for="day in days" :value="{id: day.id, dayselected:day.day}">
                                    @{{ day . day }} Nights</option>
                            </select>
                            </div>

                             <div class="d-flex justify-content-around">
                                        <div>
                                            <a href="#" class="col-sm-4 icon">
                                                <input type="radio" name="nights" id="nights1"  value="1" v-model="selectednight" @change="Calculateradio">
                                                <label for="nights1">
                                                    4
                                                </label>
                                            </a>
                                        </div>
                                        <div class="">
                                            <a href="#" class="col-sm-4 icon">
                                                <input type="radio" name="nights" id="nights2" value="2" v-model="selectednight" @change="Calculateradio">
                                                <label for="nights2">
                                                 5
                                                </label>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="#" class="col-sm-4 icon">
                                                <input type="radio" name="nights" id="nights3" value="3" v-model="selectednight" @change="Calculateradio">
                                                <label for="nights3">
                                                    6
                                            </a>
                                        </div>


                                    </div>

                            

                            <div class="form-group">
                                 <label for="hotelselect">Select Hotel</label>
                            <select name="hotel" class="form-control" id="hotelselect" v-model="selectedHotel" @change="CalculatePriceForHotel">
                                <option v-for="hotel in hotels"
                                    :value="{price: hotel.price , hotelselected: hotel.name}">@{{ hotel . name }}
                                </option>
                            </select>
                            </div>

                            

                            <p> You have selected <span>@{{ this . selectedDay . dayselected }} <span
                                    v-if="this.daycheck">Nights</span> </span> at <span> @{{ this . selectedHotel . hotelselected }} </span></p>
                            
                            <h6 class="text-danger">Final price: @{{ price }} AED </h6>

                            <button type="button" class="btn btn-primary" @click="showModal = !showModal">book
                                now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div id="exampleModal">

            <!-- Modal-->
            <transition @enter="startTransitionModal" @after-enter="endTransitionModal"
                @before-leave="endTransitionModal" @after-leave="startTransitionModal">
                <div class="modal fade" v-if="showModal" ref="modal">


                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Submit Details</h5>
                                <button class="close" type="button" @click="showModal = !showModal"><span
                                        aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('expodeals-submit') }}">
                                    @csrf

                                    <input type="hidden" name="finalprice" :value="this.price">
                                    <input type="hidden" name="dayselected" :value="this.selectedDay.dayselected">
                                    <input type="hidden" name="hotelselected" :value="this.selectedHotel.hotelselected">


                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Name:</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-row">

                                        <div class="col">
                                            <label for="recipient-name" class="col-form-label">Phone:</label>
                                            <input type="text" name="phone" id="phone" class="form-control" required>
                                        </div>

                                        <div class="col">
                                            <label for="recipient-name" class="col-form-label">Email:</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>

                                    </div>

                                    {{-- <div class="form-row">
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Nationality</label>
                                <input type="text" name="nationality" class="form-control" required>
                            </div>
                            <div class="col">

                                <label for="recipient-name" class="col-form-label">Number of Adults</label>
                                <input type="text" name="no_of_adults" id="phone" class="form-control" required>

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Number of Children</label>
                                <input type="text" name="no_of_children" placeholder="Leave blank if No child" id="phone"
                                    class="form-control">
                            </div>
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Children Age ( comma seperated ) </label>
                                <input type="text" name="children_age" placeholder="Leave blank if No child" id="phone"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Special Requests:</label>
                            <textarea class="form-control" id="message-text" name="specialrequest"></textarea>
                        </div> --}}
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" @click="showModal = !showModal">Close</button>
                                        <button class="btn btn-primary" type="submit">Proceed</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </transition>
            <div class="modal-backdrop fade d-none" ref="backdrop"></div>
        </div>

        {{-- testing ends --}}


    </div>

    <script>
        new Vue({
            el: '#content',
            data: () => ({

                showModal: false,

                is_modal_visible: false,

                price: 0,

                daycheck: false,
                selectednight:'',

                selectedDay: {
                    price: 0,
                    dayselected: ''
                },

                selectedHotel: {
                    price: 0,
                    hotelselected: ''
                },

                days: [{
                        day: 6,
                        id: 0
                    },
                    {
                        day: 7,
                        id: 1
                    },
                    {
                        day: 8,
                        id: 2
                    },
                ],

                hotels: [

                    {
                        name: 'hotel1',
                        price: [100, 200, 300]
                    },
                    {
                        name: 'hotel2',
                        price: [1000, 2000, 3000]
                    },
                    {
                        name: 'hotel3',
                        price: [10000, 20000, 30000]
                    },

                ]

            }),
            methods: {

                Calculateradio(event) {
                    console.log(this.selectednight);
                },

                CalculatePrice(event) {

                    this.price = this.selectedHotel.price[this.selectedDay.id];
                    this.daycheck = true;
                },

                CalculatePriceForHotel(event) {

                    this.price = this.selectedHotel.price[this.selectedDay.id];
                },

                openModal() {
                    this.is_modal_visible = true;
                },

                // testing

                startTransitionModal() {
                    this.$refs.backdrop.classList.toggle("d-block");
                    this.$refs.modal.classList.toggle("d-block");
                },
                endTransitionModal() {
                    this.$refs.backdrop.classList.toggle("show");
                    this.$refs.modal.classList.toggle("show");
                }

            }
        });
    </script>



</body>

</html>
