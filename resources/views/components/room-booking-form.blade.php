<div class="col-md-6 bg-dark d-flex align-items-center" id="bookingForm">
    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
        <h1 class="text-white mb-4">Book A Room Online</h1>
        <form action="search">
            <input type="hidden" name="title" value="Select Your Room">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="booking_name" id="name" placeholder="Your Name">
                        <label for="name">Your Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" class="form-control" name="booking_email" id="email"
                            placeholder="Your Email">
                        <label for="email">Your Email</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="booking_guest" id="guest" placeholder="Guest">
                        <label for="guest">Guest</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" name="booking_roomType" id="select1">
                            <option value="">Select Room Type</option>
                            <option value="Standard">Standard</option>
                            <option value="Deluxe">Deluxe</option>
                            <option value="Luxury">Luxury</option>
                            <option value="Suite">Suite</option>
                        </select>
                        <label for="select1">Room Type</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating date" id="date3" data-target-input="nearest">
                        <input type="date" class="form-control datetimepicker-input" name="booking_checkInDate_time"
                            id="checkInDate&time" placeholder="Check In Date & Time" data-target="#date3"
                            data-toggle="datetimepicker" />
                        <label for="checkInDate&time">Check In Date & Time</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating date" id="date3" data-target-input="nearest">
                        <input type="date" class="form-control datetimepicker-input" name="booking_checkOutDate_time"
                            id="checkOutDate&time" placeholder="Check Out Date & Time" data-target="#date4"
                            data-toggle="datetimepicker" />
                        <label for="checkOutDate&time">Check Out Date & Time</label>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                </div>
            </div>
        </form>
    </div>
</div>
