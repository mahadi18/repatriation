@extends('print')
@section('content')
<section class="">
    <h2>NGO HIR for {{$litigation->name_during_rescue}}</h2>
    <hr>
    <h3>Interview Information</h3>
    <div class="container" style="width: 100%">
    <section class="panel">
    <div class="panel-body">
    <div class="basic-information">
        <h2>Basic Information</h2>

        <div class="row">
            <label class="col-lg-3">
                Case ID
            </label>
            <span class="col-lg-9">{{$litigation->case_id}}</span>
        </div>
        <div class="row">
            <label class="col-lg-3">
                Full Name
            </label>
            <span class="col-lg-9">{{$litigation->full_name}}</span>
        </div>
        <div class="row">
            <label class="col-lg-3">
                Photo(s)
            </label>
                <span class="col-lg-9">
                    <!--<img style="" alt="" src="{!! (!empty(get_victim_attachment('Victim Personal Image', $litigation->id)['file_path'])) ? get_victim_attachment('Victim Personal Image', $litigation->id)['file_path'] : '/uploads/-text.png' !!}"/>-->
                    <div class="profile_photos">
                        <?php echo get_attachments_of_victim('Victim Personal Image', $litigation->id); ?>
                    </div>
                </span>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <label class="col-lg-6">
                        Age
                    </label>
                        <span class="col-lg-6">
                            {{$litigation->age_year_part}}
                        </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <label class="col-lg-6">
                        Nationality
                    </label>
                        <span class="col-lg-6">
                            {{$litigation->country($litigation->nationality)}}
                        </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <label class="col-lg-6">
                        Father's Name
                    </label>
                        <span class="col-lg-6">
                            {{$litigation->father_name}}
                        </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <label class="col-lg-6">
                        Religion
                    </label>
                        <span class="col-lg-6">
                            {{$litigation->religion}}
                        </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <label class="col-lg-6">
                        Mother's Name
                    </label>
                        <span class="col-lg-6">
                            {{$litigation->mother_name}}
                        </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <label class="col-lg-6">
                        Educational Qualification
                    </label>
                        <span class="col-lg-6">
                            {{$litigation->education}}
                        </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <label class="col-lg-6">
                        Guardian Name
                    </label>
                        <span class="col-lg-6">
                            {{$litigation->father_name}}
                        </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <label class="col-lg-6">
                        Marital Status
                    </label>
                        <span class="col-lg-6">
                            {{$litigation->marital_status == 'S' ? 'Single' : 'Married' }}
                        </span>
                </div>
            </div>
            <div class="col-lg-offset-6 col-lg-6">
                <div class="row">
                    <label class="col-lg-6">
                        Spouse Name
                    </label>
                        <span class="col-lg-6">
                            {{$litigation->spouse_name}}
                        </span>
                </div>
            </div>
        </div>
    </div>
    <div class="address">
        <h2 style="margin-bottom: -5px">
            Address
        </h2>
        <div class="row">
            @foreach ($litigation->addresses as $address)
            <div class="col-lg-6">
                <div class="{{$address->present_address}} area">
                    <h5 style="text-transform: capitalize">{{str_replace('_', ' ', $address->title)}}</h5>
                    <div class="content">
                        <div class="row">
                            <label class="col-lg-6">C/O</label>
                            <span class="col-lg-6">{{$address->care_of}}</span>
                        </div>
                        <div class="row">
                            <label class="col-lg-6">Relation</label>
                            <span class="col-lg-6">{{$address->relation_with_survivor}}</span>
                        </div>
                        <div class="row">
                            <label class="col-lg-6">Address</label>
                                <span class="col-lg-6">
                                    <p>{{$address->address_line_1}}</p>
                                    <p>{{$address->address_line_2}}</p>
                                </span>
                        </div>
                        <div class="row">
                            <label class="col-lg-6">Post Code</label>
                            <span class="col-lg-6">{{$address->postal_code}}</span>
                        </div>
                        <div class="row">
                            <label class="col-lg-6">Contact Number</label>
                            <span class="col-lg-6">{{$address->contact_number}}</span>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
    <div class="physical-description">
        <h2>Physical Description</h2>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <label class="col-lg-6">Height</label>
                        <span class="col-lg-6">
                            4 ft 5 inch
                        </span>
                </div>
                <div class="row">
                    <label class="col-lg-6">Gender</label>
                        <span class="col-lg-6">
                            @if ($litigation->sex === 'F')
                                Female
                            @elseif ($litigation->sex === 'M')
                                Male
                            @else
                                Other
                            @endif
                        </span>
                </div>
                <div class="row">
                    <label class="col-lg-6">Pregnant</label>
                        <span class="col-lg-6">
                            {{$litigation->pregnancy}}
                        </span>
                </div>
                <div class="row">
                    <label class="col-lg-6">Accompanied by Child</label>
                        <span class="col-lg-6">
                            N/A
                        </span>
                </div>
                <div class="row">
                    <label class="col-lg-6">Substance Abuse</label>
                        <span class="col-lg-6">
                           N/A
                        </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="distinguishables">
                    <h3> Distinguished Features </h3>
                    <div class="row">
                        <label class="col-lg-6">Birth Mark</label>
                            <span class="col-lg-6">
                                N/A
                            </span>
                    </div>
                    <div class="row">
                        <label class="col-lg-6">Complexion</label>
                            <span class="col-lg-6">
                                N/A
                            </span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="clearfix">&nbsp;</div>
    </div>
    </section>

</section>
@endsection

<style>
    @media only print {

        body {
            font-family: arial, sans-serif;
        }
        .row {

            width: 100%;
            clear: both;
        }

        h4 {
            text-transform: capitalize;
        }

        .col-lg-1,.col-lg-2, .col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,
        .col-lg-7,.col-lg-8,.col-lg-9,.col-lg-10,.col-lg-11,.col-lg-12 {
            position: relative;
            min-height: 1px;
            float: left;
        }

        .col-lg-12 {
            width: 100%;
        }
        .col-lg-11 {
            width: 91.66666667%;
        }
        .col-lg-10 {
            width: 83.33333333%;
        }
        .col-lg-9 {
            width: 75%;
        }
        .col-lg-8 {
            width: 66.66666667%;
        }
        .col-lg-7 {
            width: 58.33333333%;
        }
        .col-lg-6 {
            width: 50%;
        }
        .col-lg-5 {
            width: 41.66666667%;
        }
        .col-lg-4 {
            width: 33.33333333%;
        }
        .col-lg-3 {
            width: 25%;
        }
        .col-lg-2 {
            width: 16.66666667%;
        }
        .col-lg-1 {
            width: 8.33333333%;
        }

        h4 {
            margin-top: 0;
        }

        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .documents img {
            width: 100px;
            height: auto;
        }
    }

</style>