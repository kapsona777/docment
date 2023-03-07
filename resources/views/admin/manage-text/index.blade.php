@extends('layouts.admin.layout')
@section('title','Text')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Website Text</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.update.text') }}" method="post">
                    @csrf
                    <table class="table table-bordered">

                        <tr>
                            <td>Appointment Modal Title</td>
                            <td><input type="text" name="appointment_modal_title" value="{{ $text->appointment_modal_title }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Appointment Submit Button</td>
                            <td><input type="text" name="appointment_submit_btn" value="{{ $text->appointment_submit_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Appointment Modal Close Button</td>
                            <td><input type="text" name="appointment_close_btn" value="{{ $text->appointment_close_btn }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Doctor Search Button</td>
                            <td><input type="text" name="doctor_search_btn" value="{{ $text->doctor_search_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Service Learn More</td>
                            <td><input type="text" name="service_learn_more" value="{{ $text->service_learn_more }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>View All Service Button</td>
                            <td><input type="text" name="service_btn" value="{{ $text->service_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>View All Department Button</td>
                            <td><input type="text" name="department_btn" value="{{ $text->department_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Subscribe Button</td>
                            <td><input type="text" name="subscribe_btn" value="{{ $text->subscribe_btn }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Email Address</td>
                            <td><input type="text" name="email_address" value="{{ $text->email_address }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><input type="text" name="phone" value="{{ $text->phone }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" name="address" value="{{ $text->address }}" class="form-control"></td>
                        </tr>



                        <tr>
                            <td>Footer About Us</td>
                            <td><input type="text" name="footer_about_us" value="{{ $text->footer_about_us }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Footer Important Links</td>
                            <td><input type="text" name="footer_importent_link" value="{{ $text->footer_importent_link }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Footer Recent Post</td>
                            <td><input type="text" name="footer_recent_post" value="{{ $text->footer_recent_post }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Department Read More Button</td>
                            <td><input type="text" name="department_read_more_btn" value="{{ $text->department_read_more_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Department Doctor</td>
                            <td><input type="text" name="department_doctor" value="{{ $text->department_doctor }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Frequently Ask Questions</td>
                            <td><input type="text" name="frequently_ask_questions" value="{{ $text->frequently_ask_questions }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Related Video</td>
                            <td><input type="text" name="related_video" value="{{ $text->related_video }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Details</td>
                            <td><input type="text" name="blog_learn_more" value="{{ $text->blog_learn_more }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Blog Category</td>
                            <td><input type="text" name="blog_category" value="{{ $text->blog_category }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Blog Recent Post</td>
                            <td><input type="text" name="blog_recent_post" value="{{ $text->blog_recent_post }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Comments</td>
                            <td><input type="text" name="comments" value="{{ $text->comments }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Sumbit a Comment</td>
                            <td><input type="text" name="get_comment" value="{{ $text->get_comment }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Comment Submit Button</td>
                            <td><input type="text" name="comment_submit_btn" value="{{ $text->comment_submit_btn }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Quick Contact</td>
                            <td><input type="text" name="quick_contact" value="{{ $text->quick_contact }}" class="form-control"></td>
                        </tr>


                        <tr>
                            <td>Message Subject</td>
                            <td><input type="text" name="subject" value="{{ $text->subject }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Send Messge Button</td>
                            <td><input type="text" name="send_msg_btn" value="{{ $text->send_msg_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Appointment Fee</td>
                            <td><input type="text" name="appointment_fee" value="{{ $text->appointment_fee }}" class="form-control"></td>
                        </tr>


                        <tr>
                            <td>Doctor Information</td>
                            <td><input type="text" name="doctor_info" value="{{ $text->doctor_info }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Doctor Working Hours</td>
                            <td><input type="text" name="doctor_working_hours" value="{{ $text->doctor_working_hours }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Doctor Address</td>
                            <td><input type="text" name="doctor_address" value="{{ $text->doctor_address }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Doctor Education</td>
                            <td><input type="text" name="doctor_education" value="{{ $text->doctor_education }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Doctor Experience</td>
                            <td><input type="text" name="doctor_experience" value="{{ $text->doctor_experience }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Doctor Qualification</td>
                            <td><input type="text" name="doctor_qualification" value="{{ $text->doctor_qualification }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Doctor Book Appointment</td>
                            <td><input type="text" name="doctor_book_appointment" value="{{ $text->doctor_book_appointment }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Doctor Book Appointment Title</td>
                            <td><input type="text" name="doctor_book_appointment_title" value="{{ $text->doctor_book_appointment_title }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Login Button Text</td>
                            <td><input type="text" name="login_btn" value="{{ $text->login_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Login Here Text</td>
                            <td><input type="text" name="login_text" value="{{ $text->login_text }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Register Button</td>
                            <td><input type="text" name="register_btn" value="{{ $text->register_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Register Here Text</td>
                            <td><input type="text" name="register_text" value="{{ $text->register_text }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Forget Password Button Text</td>
                            <td><input type="text" name="forget_pass_btn" value="{{ $text->forget_pass_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Forget Password Here Text</td>
                            <td><input type="text" name="forget_pass_text" value="{{ $text->forget_pass_text }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Reset Password Button Text</td>
                            <td><input type="text" name="reset_pass_btn" value="{{ $text->reset_pass_btn }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Appointment List</td>
                            <td><input type="text" name="appointment_list" value="{{ $text->appointment_list }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Pay Now</td>
                            <td><input type="text" name="pay_now" value="{{ $text->pay_now }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Stripe</td>
                            <td><input type="text" name="stripe" value="{{ $text->stripe }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Stripe Card Error</td>
                            <td><input type="text" name="stripe_card_error" value="{{ $text->stripe_card_error }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Stripe Button</td>
                            <td><input type="text" name="stripe_btn" value="{{ $text->stripe_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Paypal</td>
                            <td><input type="text" name="paypal" value="{{ $text->paypal }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Paypal Button</td>
                            <td><input type="text" name="paypal_btn" value="{{ $text->paypal_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Direct Bank Transfer</td>
                            <td><input type="text" name="bank_transfer" value="{{ $text->bank_transfer }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Bank Transfer Button</td>
                            <td><input type="text" name="bank_transfer_btn" value="{{ $text->bank_transfer_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Bank Account Info</td>
                            <td><input type="text" name="bank_account_info" value="{{ $text->bank_account_info }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Transaction Info</td>
                            <td><input type="text" name="transaction_info" value="{{ $text->transaction_info }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Total Order</td>
                            <td><input type="text" name="total_order" value="{{ $text->total_order }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Total Appointment</td>
                            <td><input type="text" name="total_appointment" value="{{ $text->total_appointment }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Pending Appointment</td>
                            <td><input type="text" name="pending_appointment" value="{{ $text->pending_appointment }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Dashboard</td>
                            <td><input type="text" name="dashboard" value="{{ $text->dashboard }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Message</td>
                            <td><input type="text" name="message" value="{{ $text->message }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Comment</td>
                            <td><input type="text" name="comment" value="{{ $text->comment }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Send Message Button</td>
                            <td><input type="text" name="send_message_btn" value="{{ $text->send_message_btn }}" class="form-control"></td>
                        </tr>


                        <tr>
                            <td>Account Info</td>
                            <td><input type="text" name="account_info" value="{{ $text->account_info }}" class="form-control"></td>
                        </tr>


                        <tr>
                            <td>Order List</td>
                            <td><input type="text" name="order_list" value="{{ $text->order_list }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Change Password</td>
                            <td><input type="text" name="change_password" value="{{ $text->change_password }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Logout</td>
                            <td><input type="text" name="logout" value="{{ $text->logout }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Update Profile Button</td>
                            <td><input type="text" name="update_profile_btn" value="{{ $text->update_profile_btn }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Patient Id</td>
                            <td><input type="text" name="patient_id" value="{{ $text->patient_id }}" class="form-control"></td>
                        </tr>


                        <tr>
                            <td>Order Info</td>
                            <td><input type="text" name="order_info" value="{{ $text->order_info }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Appointment History</td>
                            <td><input type="text" name="appointment_history" value="{{ $text->appointment_history }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Billing Info</td>
                            <td><input type="text" name="billing_info" value="{{ $text->billing_info }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Patient Physical Info</td>
                            <td><input type="text" name="pyshical_info" value="{{ $text->pyshical_info }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Prescribe</td>
                            <td><input type="text" name="prescribe" value="{{ $text->prescribe }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Advice</td>
                            <td><input type="text" name="advice" value="{{ $text->advice }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Post Not Found</td>
                            <td><input type="text" name="post_not_found" value="{{ $text->post_not_found }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Doctor Not Found</td>
                            <td><input type="text" name="doctor_not_found" value="{{ $text->doctor_not_found }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Schedule Not Found</td>
                            <td><input type="text" name="schedule_not_found" value="{{ $text->schedule_not_found }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Select Department</td>
                            <td><input type="text" name="select_department" value="{{ $text->select_department }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Select Doctor</td>
                            <td><input type="text" name="select_doctor" value="{{ $text->select_doctor }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Select date</td>
                            <td><input type="text" name="select_date" value="{{ $text->select_date }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Select Schedule</td>
                            <td><input type="text" name="select_schedule" value="{{ $text->select_schedule }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Select Location</td>
                            <td><input type="text" name="select_location" value="{{ $text->select_location }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Select Gender</td>
                            <td><input type="text" name="select_gender" value="{{ $text->select_gender }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Male(gender)</td>
                            <td><input type="text" name="male" value="{{ $text->male }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>FeMale(gender)</td>
                            <td><input type="text" name="female" value="{{ $text->female }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Others(gender)</td>
                            <td><input type="text" name="others" value="{{ $text->others }}" class="form-control"></td>
                        </tr>




                        <tr>
                            <td>Admin</td>
                            <td><input type="text" name="admin" value="{{ $text->admin }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Week Day</td>
                            <td><input type="text" name="week_day" value="{{ $text->week_day }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Schedule</td>
                            <td><input type="text" name="schedule" value="{{ $text->schedule }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Doctor</td>
                            <td><input type="text" name="doctor" value="{{ $text->doctor }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td><input type="text" name="department" value="{{ $text->department }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td><input type="text" name="location" value="{{ $text->location }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td><input type="text" name="date" value="{{ $text->date }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Action</td>
                            <td><input type="text" name="action" value="{{ $text->action }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><input type="text" name="total" value="{{ $text->total }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Card Number</td>
                            <td><input type="text" name="card_number" value="{{ $text->card_number }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>CVC</td>
                            <td><input type="text" name="cvc" value="{{ $text->cvc }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Expiration Month</td>
                            <td><input type="text" name="expiration_month" value="{{ $text->expiration_month }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Expiration Year</td>
                            <td><input type="text" name="expiration_year" value="{{ $text->expiration_year }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Patient Name</td>
                            <td><input type="text" name="name" value="{{ $text->name }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Guardian Name</td>
                            <td><input type="text" name="guardian_name" value="{{ $text->guardian_name }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Guardian Phone</td>
                            <td><input type="text" name="guardian_phone" value="{{ $text->guardian_phone }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Patient Age</td>
                            <td><input type="text" name="patient_age" value="{{ $text->patient_age }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Occupation</td>
                            <td><input type="text" name="occupation" value="{{ $text->occupation }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><input type="text" name="gender" value="{{ $text->gender }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td><input type="text" name="country" value="{{ $text->country }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td><input type="text" name="city" value="{{ $text->city }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Photo</td>
                            <td><input type="text" name="photo" value="{{ $text->photo }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><input type="text" name="date_of_birth" value="{{ $text->date_of_birth }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td><input type="text" name="weight" value="{{ $text->weight }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Height</td>
                            <td><input type="text" name="height" value="{{ $text->height }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Helth Insurance Number</td>
                            <td><input type="text" name="helth_insurance_number" value="{{ $text->helth_insurance_number }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Helth Card Number</td>
                            <td><input type="text" name="helth_card_number" value="{{ $text->helth_card_number }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Helth Card Provider</td>
                            <td><input type="text" name="helth_card_provider" value="{{ $text->helth_card_provider }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Blood Group</td>
                            <td><input type="text" name="blood_group" value="{{ $text->blood_group }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Disablities</td>
                            <td><input type="text" name="disablities" value="{{ $text->disablities }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Serial Number</td>
                            <td><input type="text" name="Serial_number" value="{{ $text->Serial_number }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Payment</td>
                            <td><input type="text" name="payment" value="{{ $text->payment }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Already Treated</td>
                            <td><input type="text" name="treated" value="{{ $text->treated }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Order Id</td>
                            <td><input type="text" name="order_id" value="{{ $text->order_id }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Payment Method</td>
                            <td><input type="text" name="payment_method" value="{{ $text->payment_method }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Payment Transaction Id</td>
                            <td><input type="text" name="transaction_id" value="{{ $text->transaction_id }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Payment Description</td>
                            <td><input type="text" name="description" value="{{ $text->description }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Blood Pressure</td>
                            <td><input type="text" name="blood_pressure" value="{{ $text->blood_pressure }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Patient Pulse Rate</td>
                            <td><input type="text" name="pulse_rate" value="{{ $text->pulse_rate }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Patient Health Temperature</td>
                            <td><input type="text" name="temperature" value="{{ $text->temperature }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Patient Habits</td>
                            <td><input type="text" name="habits" value="{{ $text->habits }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Patient Problems</td>
                            <td><input type="text" name="problems" value="{{ $text->problems }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Medicine Type</td>
                            <td><input type="text" name="medicine_type" value="{{ $text->medicine_type }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Medicine Name</td>
                            <td><input type="text" name="medicine_name" value="{{ $text->medicine_name }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Medicine Dosage</td>
                            <td><input type="text" name="dosage" value="{{ $text->dosage }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Dosage Days</td>
                            <td><input type="text" name="day" value="{{ $text->day }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Dosage Time</td>
                            <td><input type="text" name="time" value="{{ $text->time }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Test Description</td>
                            <td><input type="text" name="test_description" value="{{ $text->test_description }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Password</td>
                            <td><input type="text" name="password" value="{{ $text->password }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Confirm Password</td>
                            <td><input type="text" name="confirm_password" value="{{ $text->confirm_password }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Change Password Button</td>
                            <td><input type="text" name="change_password_btn" value="{{ $text->change_password_btn }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Not Found</td>
                            <td><input type="text" name="not_found" value="{{ $text->not_found }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Upcoming Meeting</td>
                            <td><input type="text" name="upcoming_meeting" value="{{ $text->upcoming_meeting }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Meeting History</td>
                            <td><input type="text" name="meeting_history" value="{{ $text->meeting_history }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Duration</td>
                            <td><input type="text" name="duration" value="{{ $text->duration }}" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>Meeting Id</td>
                            <td><input type="text" name="meeting_id" value="{{ $text->meeting_id }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Join Link</td>
                            <td><input type="text" name="join_link" value="{{ $text->join_link }}" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Minute</td>
                            <td><input type="text" name="minute" value="{{ $text->minute }}" class="form-control"></td>
                        </tr>









                    </table>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
