<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Survey</title>

    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> --}}
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
        
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }
        .page-wrapper{
            font-family: 'Roboto', sans-serif;
            /* border: 1px solid #ddd; */
            margin: 10px auto;
            padding: 10px;
            width: 700px;
        }

        .page-wrapper .sheet-heading{
            display: block;         
            position: relative;
            margin-bottom: 30px;
            width: 100%;            
        }

        .page-wrapper .sheet-heading .heading{
            display: block;
            text-align: center;
            width: 100%;
        }

        .page-wrapper .logo-heading{
            display: block;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;            
            position: relative;
            margin-bottom: 50px;
            width: 100%;
            
        }

        .page-wrapper .logo-heading .logo,
        .page-wrapper .logo-heading .heading{
            display: inline-block;
            width: 49%;
            vertical-align: middle;
        }

        .page-wrapper .logo-heading .logo img{
            display: inline-block;
            margin-bottom: 15px;
            width: 120px;
        }
        .page-wrapper .logo-heading .logo .company-detail{
            font-size: 13px;
            margin-bottom: 0px;
        }

        .page-wrapper .logo-heading .heading .company-detail{
            font-size: 13px;
            margin-bottom: 0px;
        }

        .page-wrapper .logo-heading .heading{
            text-align: right;
        }
        .page-wrapper .logo-heading .heading h2{
            display: inline-block;
            font-size: 1.75rem;
        }

        .page-wrapper .employee-detail{
            display: block;
            position: relative;
            width: 100%;
        }

        .page-wrapper .table{
            border: 1px solid #ddd;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 50px;
            width: 100%
        }

        .page-wrapper .table thead tr th,
        .page-wrapper .table tbody tr td{
            border-bottom: 1px solid #ddd;
            padding: 10px 15px;
            vertical-align: middle;
        }

        .page-wrapper .table thead tr th{
            border-bottom: 2px solid #555;
            padding: 15px 15px;
            text-align: left;
        }
        .page-wrapper .table tbody tr td{
            text-align: left;
        }

        .page-wrapper .table-emp{
            /* border: 1px solid #ddd; */
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
            width: 100%;
        }
       
        .page-wrapper .table-emp tbody tr td{
            padding: 7px 0px;
            vertical-align: top;
        }
        .page-wrapper .table-emp tbody tr >td:first-child{
            padding-left: 0px;
            width: 50%;
        }
        /* .page-wrapper .table-emp tbody tr >td .row strong{
            width: 80px;
            padding-right: 10px;
        } */
        .page-wrapper .authorized{
            position: relative;
            margin-bottom: 10px;
            width: 100%;
        }
        .page-wrapper .authorized label{
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            display: block;
        }
        .page-wrapper .authorized .detail{
            text-align: right;
        }
        .page-wrapper .authorized .detail .data{
            display: block;
            padding: 7px 0px;
        }

        .page-wrapper .authorized .detail .data img{
            display: inline-block;
            width: 150px;
        }
        .page-wrapper .authorized .detail .data.justify{
            text-align: justify;
        }

        .page-wrapper .table-footer{
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 50px;
            width: 100%;
        }

        .page-wrapper .table-footer tbody tr td:first-child{
            width: 70%
        }

        .page-wrapper .table-footer tbody tr td .detail{
            display: block;
            margin-bottom: 10px; 
        }

        .page-wrapper .table-footer tbody tr td .detail .strong{
            margin-bottom: 5px; 
        }

        .page-wrapper .table-footer tbody tr td .detail .data img{
            display: inline-block;
            /* width: 120px; */
        }

        .strong-text{
            margin-right: 10px;
            width: 150px; 
        }
        
        @page {
                size: A4;
                margin-top: 10px;
                margin-left: auto;
                margin-right: auto;
                /* margin-bottom: 0; */
                width: 500px;
            }

        @media print {
            @page {
                width: 100%;
                height: 297mm;
            }            
            .page-wrapper{
                position: relative;
                margin-top: 20px;
                margin-bottom: 20px;
            }
            .page-wrapper .table thead tr th{
                background-color: #ddd !important;
                -webkit-print-color-adjust: exact;
            }
        }

    </style>
</head>
<body>
  <div class="page-wrapper">

    <div class="sheet-heading">
        <div class="heading">
            <h2>Time Sheet</h2>
        </div>  
    </div>

    <div class="logo-heading">
        <div class="logo">
            @if ($result->image != null)
            {{-- <img src={{$timesheet->company->logo}}> --}}
            <img src="{{ asset('uploads/'.$result->image) }}"/>
            @endif
            <div class="company-detail">{{ $result->name }}</div>
            <div class="company-detail">{{ $result->address}}</div>
            <div class="company-detail">{{ $result->city }}</div>
        </div>
  
        {{-- <div class="heading">
            @if ($timesheet->branch != null)
                @if ($timesheet->unit != null)
                    <div class="company-detail">{{ $timesheet->client->name.", ".$timesheet->branch->name.",".$timesheet->unit->name}}</div>
                @else
                    <div class="company-detail">{{ $timesheet->client->name.", ".$timesheet->branch->name }}</div>
                @endif
                <div class="company-detail">{{ $timesheet->branch->address.", ".$timesheet->branch->address_2 }}</div>
                <div class="company-detail">{{ $timesheet->branch->post_code }}</div>
            @else
                <div class="company-detail">{{ $timesheet->client->name }}</div>
                <div class="company-detail">{{ $timesheet->client->address.", ".$timesheet->client->address_2 }}</div>
                <div class="company-detail">{{ $timesheet->client->post_code }}</div>
            @endif
        </div> --}}
    </div>

   
    {{-- @if ($timesheet->note != null)
        <div class="authorized">
            <div class="detail">
                <label>Note</label>
                <div class="data justify">{{ $timesheet->note }}</div>
            </div>
        </div>
    @endif
    <div class="authorized">
        <div class="detail">
            <label>Authorized By</label>
            <div class="data">{{$timesheet->authorizedBy->name}}</div>
        </div>
        <div class="detail">
            <label>Signature</label>
            <div class="data">
                <p></p>
                <img src={{asset('/uploads' . '/' . $timesheet->signature)}} alt="signature">
            </div>
        </div>
    </div> --}}
    {{-- <div class="authorized">
        
    </div> --}}


</div>
    
</body>
</html>