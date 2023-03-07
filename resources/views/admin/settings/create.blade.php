@extends('layouts.admin.layout')
@section('title','Settings')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Settings Information</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Logo</label>
                            <input type="file" name="logo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Favicon</label>
                            <input type="file" name="favicon" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Email For Send Contact Message</label>
                            <input type="email" name="email" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="">Save Contact Message in Database? </label>
                            <select name="save_contact_message" id="" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Patient Can Register/Login ?</label>
                            <select name="patient_can_register" id="" class="form-control">
                                <option  value="1">Yes</option>
                                <option  value="0">No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Text Direction</label>
                            <select name="text_direction" id="" class="form-control">
                                <option  value="LTR">LTR</option>
                                <option  value="RTL">RTL</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Currency Name</label>
                            <input type="text" class="form-control" name="currency_name">
                        </div>
                        <div class="form-group">
                            <label for="">Currency Icon</label>
                            <input type="text" class="form-control" name="currency_icon">
                        </div>
                        <div class="form-group">
                            <label for="">Appointment Pre Notification Hour</label>
                            <input type="number" class="form-control" name="prenotification_hour">
                        </div>


                        <div class="form-group">
                            <label for="">TimeZone</label>
                            <select name="timezone" id="" class="form-control select2">
                                <option value="GMT">GMT timezone</option>
                                <option value="UTC">UTC timezone</option>
                                <option value="Africa/Abidjan">(GMT/UTC + 00:00) Abidjan</option>
                                <option value="Africa/Accra">(GMT/UTC + 00:00) Accra</option>
                                <option value="Africa/Addis_Ababa">(GMT/UTC + 03:00) Addis Ababa</option>
                                <option value="Africa/Algiers">(GMT/UTC + 01:00) Algiers</option>
                                <option value="Africa/Asmara">(GMT/UTC + 03:00) Asmara</option>
                                <option value="Africa/Bamako">(GMT/UTC + 00:00) Bamako</option>
                                <option value="Africa/Bangui">(GMT/UTC + 01:00) Bangui</option>
                                <option value="Africa/Banjul">(GMT/UTC + 00:00) Banjul</option>
                                <option value="Africa/Bissau">(GMT/UTC + 00:00) Bissau</option>
                                <option value="Africa/Blantyre">(GMT/UTC + 02:00) Blantyre</option>
                                <option value="Africa/Brazzaville">(GMT/UTC + 01:00) Brazzaville</option>
                                <option value="Africa/Bujumbura">(GMT/UTC + 02:00) Bujumbura</option>
                                <option value="Africa/Cairo">(GMT/UTC + 02:00) Cairo</option>
                                <option value="Africa/Casablanca">(GMT/UTC + 00:00) Casablanca</option>
                                <option value="Africa/Ceuta">(GMT/UTC + 01:00) Ceuta</option>
                                <option value="Africa/Conakry">(GMT/UTC + 00:00) Conakry</option>
                                <option value="Africa/Dakar">(GMT/UTC + 00:00) Dakar</option>
                                <option value="Africa/Dar_es_Salaam">(GMT/UTC + 03:00) Dar es Salaam</option>
                                <option value="Africa/Djibouti">(GMT/UTC + 03:00) Djibouti</option>
                                <option value="Africa/Douala">(GMT/UTC + 01:00) Douala</option>
                                <option value="Africa/El_Aaiun">(GMT/UTC + 00:00) El Aaiun</option>
                                <option value="Africa/Freetown">(GMT/UTC + 00:00) Freetown</option>
                                <option value="Africa/Gaborone">(GMT/UTC + 02:00) Gaborone</option>
                                <option value="Africa/Harare">(GMT/UTC + 02:00) Harare</option>
                                <option value="Africa/Johannesburg">(GMT/UTC + 02:00) Johannesburg</option>
                                <option value="Africa/Juba">(GMT/UTC + 03:00) Juba</option>
                                <option value="Africa/Kampala">(GMT/UTC + 03:00) Kampala</option>
                                <option value="Africa/Khartoum">(GMT/UTC + 03:00) Khartoum</option>
                                <option value="Africa/Kigali">(GMT/UTC + 02:00) Kigali</option>
                                <option value="Africa/Kinshasa">(GMT/UTC + 01:00) Kinshasa</option>
                                <option value="Africa/Lagos">(GMT/UTC + 01:00) Lagos</option>
                                <option value="Africa/Libreville">(GMT/UTC + 01:00) Libreville</option>
                                <option value="Africa/Lome">(GMT/UTC + 00:00) Lome</option>
                                <option value="Africa/Luanda">(GMT/UTC + 01:00) Luanda</option>
                                <option value="Africa/Lubumbashi">(GMT/UTC + 02:00) Lubumbashi</option>
                                <option value="Africa/Lusaka">(GMT/UTC + 02:00) Lusaka</option>
                                <option value="Africa/Malabo">(GMT/UTC + 01:00) Malabo</option>
                                <option value="Africa/Maputo">(GMT/UTC + 02:00) Maputo</option>
                                <option value="Africa/Maseru">(GMT/UTC + 02:00) Maseru</option>
                                <option value="Africa/Mbabane">(GMT/UTC + 02:00) Mbabane</option>
                                <option value="Africa/Mogadishu">(GMT/UTC + 03:00) Mogadishu</option>
                                <option value="Africa/Monrovia">(GMT/UTC + 00:00) Monrovia</option>
                                <option value="Africa/Nairobi">(GMT/UTC + 03:00) Nairobi</option>
                                <option value="Africa/Ndjamena">(GMT/UTC + 01:00) Ndjamena</option>
                                <option value="Africa/Niamey">(GMT/UTC + 01:00) Niamey</option>
                                <option value="Africa/Nouakchott">(GMT/UTC + 00:00) Nouakchott</option>
                                <option value="Africa/Ouagadougou">(GMT/UTC + 00:00) Ouagadougou</option>
                                <option value="Africa/Porto-Novo">(GMT/UTC + 01:00) Porto-Novo</option>
                                <option value="Africa/Sao_Tome">(GMT/UTC + 00:00) Sao Tome</option>
                                <option value="Africa/Tripoli">(GMT/UTC + 02:00) Tripoli</option>
                                <option value="Africa/Tunis">(GMT/UTC + 01:00) Tunis</option>
                                <option value="Africa/Windhoek">(GMT/UTC + 02:00) Windhoek</option>
                            </select>
                        </div>



                        <button type="submit" class="btn btn-success">Save Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
