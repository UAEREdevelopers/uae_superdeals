
        <div class="modal fade" style="padding-top: 100px" id="userdetaisModal" tabindex="-1" role="dialog"
            aria-labelledby="userdetaisModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Submit Details  PCR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('submit_package_interest') }}" id="interestform">
                            @csrf

                            <input type="hidden" name="price" value="{{ $package->package_price }}" id="">
                            <input type="hidden" name="is_inquiry" value="1">
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
                                <div class="col-6">
                                    <label for="recipient-name" class="col-form-label">Nationality</label>
                                    <input type="text" name="nationality" class="form-control" required>
                                </div>
                                <div class="col-6">

                                    <label for="date" class="col-form-label">Date</label>
                                    <input type="text" name="date" id="date_inquiry" class="form-control" required>

                                </div>
                            </div> --}}

                            
                            <div class="form-row">
                                <div class="col-6">
                                    <label for="recipient-name" class="col-form-label">Time</label>
                                    <select name="time" class="form-control" id="">
                                        
                                        <option value="6 AM">6:00 AM</option>
                                        <option value="7 AM">7:00 AM</option>
                                        <option value="8 AM">8:00 AM</option>
                                        <option value="9 AM">9:00 AM</option>
                                        <option value="10 AM">10:00 AM</option>
                                        <option value="11 AM">11:00 AM</option>
                                        <option value="12 PM">12:00 PM</option>     
                                        <option value="1 PM">1:00 PM</option>
                                        <option value="2 PM">2:00 PM</option>
                                        <option value="3 PM">3:00 PM</option>
                                        <option value="4 PM">4:00 PM</option>
                                        <option value="5 PM">5:00 PM</option>
                                        <option value="6 PM">6:00 PM</option>
                                        <option value="7 PM">7:00 PM</option>
                                        <option value="8 PM">8:00 PM</option>
                                        <option value="9 PM">9:00 PM</option>
                                        <option value="10 PM">10:00 PM</option>
                                        <option value="11 PM">11:00 PM</option>
                                        <option value="12 PM">12:00 AM</option>
                                        <option value="1 AM">1:00 AM</option>
                                        <option value="2 AM">2:00 AM</option>
                                        <option value="3 AM">3:00 AM</option>
                                        <option value="4 AM">4:00 AM</option>
                                        <option value="5 AM">5:00 AM</option>     
                                    </select>
                                </div>
                                <div class="col-6">

                                    <label for="date" class="col-form-label">Date</label>
                                    <input type="text" name="date" id="date_inquiry_pcr" class="form-control" required>

                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-6">
                                     <label for="city" class="col-form-label">City</label>
                                     <select name="city" class="form-control">
                                    <option value="Dubai" selected>Dubai</option>
                                     <option value="sharjah">sharjah</option>  
                                    </select>

                                </div>
                                <div class="col-6">
                                      <label for="area" class="col-form-label">Area</label>
                                    <input type="text" name="area" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="form-group">                               
                                    <label for="recipient-name" class="col-form-label">Number of Adults</label>
                                    <select name="adults" id="" class="form-control">
                                        <option value="0" selected>0</option>
                                        @for ($i = 0; $i < 10; $i++)
                                            <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                        @endfor
                                    </select>                               
                               
                            </div>

                            <input type="hidden" id="packageid" name="packageid" class="form-control"
                                value="{{ $package->id }}">

                            

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Modal for user details End -->

        <!-- Modal for Booking -->

        <div class="modal fade" style="padding-top: 100px" id="booknowModal" tabindex="-1" role="dialog"
            aria-labelledby="booknowModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Submit Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('submit_package_interest') }}" id="interestform">
                            @csrf

                            <input type="hidden" name="packageid" value="{{ $package->id }}">
                            <input type="hidden" name="price" value="" id="totalprice">

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-row">

                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">Phone:</label>
                                    <input type="text" name="phone" id="phone2" class="form-control" required>
                                </div>

                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">Email:</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="col-6">
                                    <label for="recipient-name" class="col-form-label">Time</label>
                                    <select name="time" class="form-control" id="">
                                        <option value="6 AM">6:00 AM</option>
                                        <option value="7 AM">7:00 AM</option>
                                        <option value="8 AM">8:00 AM</option>
                                        <option value="9 AM">9:00 AM</option>
                                        <option value="10 AM">10:00 AM</option>
                                        <option value="11 AM">11:00 AM</option>
                                        <option value="12 PM">12:00 PM</option>     
                                        <option value="1 PM">1:00 PM</option>
                                        <option value="2 PM">2:00 PM</option>
                                        <option value="3 PM">3:00 PM</option>
                                        <option value="4 PM">4:00 PM</option>
                                        <option value="5 PM">5:00 PM</option>
                                        <option value="6 PM">6:00 PM</option>
                                        <option value="7 PM">7:00 PM</option>
                                        <option value="8 PM">8:00 PM</option>
                                        <option value="9 PM">9:00 PM</option>
                                        <option value="10 PM">10:00 PM</option>
                                        <option value="11 PM">11:00 PM</option>
                                        <option value="12 PM">12:00 AM</option>
                                        <option value="1 AM">1:00 AM</option>
                                        <option value="2 AM">2:00 AM</option>
                                        <option value="3 AM">3:00 AM</option>
                                        <option value="4 AM">4:00 AM</option>
                                        <option value="5 AM">5:00 AM</option>            
                                    </select>
                                </div>
                                <div class="col-6">

                                    <label for="date" class="col-form-label">Date</label>
                                    <input type="text" name="date" id="date_booking_pcr" class="form-control" required>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6">
                                     <label for="city" class="col-form-label">City</label>
                                     <select name="city" class="form-control">
                                    <option value="Dubai" selected>Dubai</option>
                                     <option value="sharjah">sharjah</option>  
                                    </select>

                                </div>
                                <div class="col-6">
                                      <label for="area" class="col-form-label">Area</label>
                                    <input type="text" name="area" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Numer of Adults</label>
                                    <select name="adults" id="" class="form-control"
                                        onchange="calculatePCRTotal(this) ">
                                        <option value="0" selected>0</option>
                                        @for ($i = 0; $i < 25; $i++)
                                            <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                        @endfor
                                    </select>                               
                            </div>

                            <div class="form-row text-center pt-4">
                                <h4 class="btn btn-danger btn-lg btn-block">Total: AED <span id="showprice">0</span></h4>
                            </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for Booking -->