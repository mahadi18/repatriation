@extends('print')
@section('content')
<section class="">
    <h2>NGO HIR for {{$litigation->name_during_rescue}}</h2>
    <hr>
    <h3>Interview Information</h3>
    <div class="container" style="width: 100%">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Interviewer</strong></div>
                    <div class="col-lg-5">{{$ngohir->name_of_interviewer}}</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Place</strong></div>
                    <div class="col-lg-5">{{$ngohir->place_of_interview}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Date</strong></div>
                    <div class="col-lg-5"><?php echo date('d M Y',strtotime($ngohir->date_of_interview))?></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Informer</strong></div>
                    <div class="col-lg-5">{{$ngohir->name_of_informer}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Survivor Name(at Source)</strong></div>
                    <div class="col-lg-5">{{$ngohir->name_of_the_survivor_at_source}}</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Survivor Name(at Destination)</strong></div>
                    <div class="col-lg-5">{{$ngohir->name_of_the_survivor_at_destination}}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Father's Name</strong></div>
                    <div class="col-lg-5">{{$ngohir->father_name}}</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Mother's Name</strong></div>
                    <div class="col-lg-5">{{$ngohir->mother_name}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Marital Status</strong></div>
                    <div class="col-lg-5"><?php echo $ngohir->marital_status == 'S' ? 'Single' : 'Married'; ?></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Spouse Name</strong></div>
                    <div class="col-lg-5">{{$ngohir->spouse_name}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Age</strong></div>
                    <div class="col-lg-5">{{$ngohir->age_year_part}}</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Gender</strong></div>
                    <div class="col-lg-5"><?php echo $ngohir->sex == 'F' ? 'Female' : 'Male'; ?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Nationality</strong></div>
                    <div class="col-lg-5">{{country_name_from_id($ngohir->nationality)}}</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Religion</strong></div>
                    <div class="col-lg-5">{{$ngohir->religion}}</div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Education</strong></div>
                    <div class="col-lg-5">{{$ngohir->education}}</div>
                </div>
            </div>
        </div>
    </div>

    <div style="clear: both"></div>
    <h3>Addresses</h3>
    <div class="container" style="width: 100%">
        <?php foreach ($ngohir->addresses as $address) { ?>
        <h4><?php
            $onlyconsonants = str_replace('_', " ", $address->title);
            echo $onlyconsonants;
            ?></h4>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Care of</strong></div>
                    <div class="col-lg-5">{{$address->care_of}}</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Relation with Survivor</strong></div>
                    <div class="col-lg-5">{{$address->relation_with_survivor}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Address 1</strong></div>
                    <div class="col-lg-5">{{$address->address_line_1}}</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Address 2</strong></div>
                    <div class="col-lg-5">{{$address->address_line_2}}</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-7"><strong>Contact Number</strong></div>
                    <div class="col-lg-5">{{$address->contact_number}}</div>
                </div>
            </div>
        </div>
            <div style="clear: both"></div>
        <?php } ?>
    </div>

    <h3>History of Previous Stay in Shelter Home or Safe Custody</h3>
    <div class="container" style="width: 100%">
        <div class="row">
            <div class="cl-lg-12">
                <?php echo strip_tags($ngohir->history_of_previous_stay); ?>
            </div>
        </div>
    </div>

    <h3>Physical Description</h3>
    <div class="container" style="width: 100%">
        <div class="row">
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                       Height
                    </div>
                    <div class="col-lg-6">
                        {{$ngohir->height_ft_part}}'.{{$ngohir->height_in_part}}"
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-lg-6">
                    Birth Mark
                </div>
                <div class="col-lg-6">
                    {{$ngohir->birth_mark}}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-lg-6">
                    Complexion
                </div>
                <div class="col-lg-6">
                    {{$ngohir->complexion}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        Pregnant
                    </div>
                    <div class="col-lg-6">
                        <?php echo $ngohir->pregnancy==1?'Yes':'No'; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-lg-6">
                    Substance Abuse
                </div>
                <div class="col-lg-6">
                    <?php echo $ngohir->abuse==1?'Yes':'No'; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-lg-6">
                    Abuse
                </div>
                <div class="col-lg-6">
                    {{$ngohir->if_yes_type}}
                </div>
            </div>
        </div>
    </div>

    <h3>Survivor’s Indentity Document List    </h3>
    <div class="container documents" style="width: 100%">
        <div class="row">
            <div class="col-lg-4">
                <strong>Date</strong>
            </div>
            <div class="col-lg-4">
                <strong>Document</strong>
            </div>
            <div class="col-lg-4">
                <strong>Document Type</strong>
            </div>
        </div>
        <?php foreach ($ngohir->files as $file ) { ?>
            <div class="row">
                <div class="col-lg-4">
                    <?php echo date('D m Y',strtotime($file->date_of_upload))?>
                </div>
                <div class="col-lg-4">
                    <img style="max-width: 200px; height: auto" src="{{$file->attachment}}" alt="{{$file->name}}">
                </div>
                <div class="col-lg-4">
                    {{$file->name}}
                </div>
            </div>
        <?php } ?>
    </div>
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