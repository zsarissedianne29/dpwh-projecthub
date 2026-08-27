@php

    /*
    |--------------------------------------------------------------------------
    | PHILIPPINE TIME
    |--------------------------------------------------------------------------
    */

    $generatedAt = \Carbon\Carbon::now('Asia/Manila');


    /*
    |--------------------------------------------------------------------------
    | PROJECT DATA
    |--------------------------------------------------------------------------
    */

    if (isset($projects)) {

        $reportProjects = collect($projects);

    } elseif (isset($project)) {

        $reportProjects = collect([$project]);

    } else {

        $reportProjects = collect();

    }


    /*
    |--------------------------------------------------------------------------
    | MONITORING MONTH
    |--------------------------------------------------------------------------
    */

    $selectedMonth = request(
        'month',
        isset($month)
            ? $month
            : now('Asia/Manila')->format('Y-m')
    );


    try {

        $monitoringDate = \Carbon\Carbon::createFromFormat(
            'Y-m',
            $selectedMonth,
            'Asia/Manila'
        );

    } catch (\Exception $e) {

        $monitoringDate = \Carbon\Carbon::now('Asia/Manila');

        $selectedMonth = $monitoringDate->format('Y-m');

    }


    $monitoringMonth = $monitoringDate->format('F Y');


    /*
    |--------------------------------------------------------------------------
    | LOGO LOADER
    |--------------------------------------------------------------------------
    */

    if (!function_exists('pdfLogo')) {

        function pdfLogo($paths)
        {
            foreach ($paths as $path) {

                if (file_exists($path)) {

                    $extension = strtolower(
                        pathinfo($path, PATHINFO_EXTENSION)
                    );


                    switch ($extension) {

                        case 'jpg':
                        case 'jpeg':

                            $mime = 'image/jpeg';

                            break;


                        case 'svg':

                            $mime = 'image/svg+xml';

                            break;


                        default:

                            $mime = 'image/png';

                            break;

                    }


                    $contents = file_get_contents($path);


                    if ($contents !== false) {

                        return 'data:' . $mime . ';base64,' .
                            base64_encode($contents);

                    }

                }

            }


            return null;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | DPWH LOGO
    |--------------------------------------------------------------------------
    */

    $dpwhLogo = pdfLogo([

        public_path('images/dpwh_logo.png'),
        public_path('images/dpwh-logo.png'),
        public_path('assets/images/dpwh_logo.png'),
        public_path('assets/images/dpwh-logo.png'),
        public_path('storage/images/dpwh_logo.png'),
        public_path('storage/dpwh_logo.png'),

    ]);


    /*
    |--------------------------------------------------------------------------
    | BAGONG PILIPINAS LOGO
    |--------------------------------------------------------------------------
    */

    $bagongPilipinasLogo = pdfLogo([

        public_path('images/bagongpilipinas_logo.png'),
        public_path('images/bagong-pilipinas-logo.png'),
        public_path('assets/images/bagongpilipinas_logo.png'),
        public_path('assets/images/bagong-pilipinas-logo.png'),
        public_path('storage/images/bagongpilipinas_logo.png'),
        public_path('storage/bagongpilipinas_logo.png'),

    ]);

@endphp


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>
        DPWH Project Accomplishment Report
    </title>


    <style>

        /*
        |--------------------------------------------------------------------------
        | PAGE
        |--------------------------------------------------------------------------
        */

        @page {

            size: A4 landscape;

            margin: 10mm 8mm 10mm 8mm;

        }


        /*
        |--------------------------------------------------------------------------
        | GENERAL
        |--------------------------------------------------------------------------
        */

        * {

            box-sizing: border-box;

        }


        html,
        body {

            color: #000000 !important;

        }


        body {

            font-family: DejaVu Sans, sans-serif;

            font-size: 7px;

            color: #000000 !important;

            margin: 0;

            padding: 0;

        }


        /*
        |--------------------------------------------------------------------------
        | FORCE ALL TEXT BLACK
        |--------------------------------------------------------------------------
        */

        body,
        div,
        span,
        p,
        table,
        thead,
        tbody,
        tr,
        th,
        td {

            color: #000000 !important;

        }


        /*
        |--------------------------------------------------------------------------
        | OFFICIAL HEADER
        |--------------------------------------------------------------------------
        */

        .official-header {

            width: 100%;

            border-bottom: 2px solid #000000;

            padding-bottom: 6px;

            margin-bottom: 7px;

            color: #000000 !important;

        }


        .header-table {

            width: 100%;

            border-collapse: collapse;

            table-layout: fixed;

        }


        .header-table td {

            border: none;

            vertical-align: middle;

            color: #000000 !important;

        }


        .logo-left {

            width: 16%;

            text-align: left;

        }


        .logo-right {

            width: 16%;

            text-align: right;

        }


        .header-center {

            width: 68%;

            text-align: center;

            line-height: 1.35;

            color: #000000 !important;

        }


        .logo {

            max-width: 75px;

            max-height: 75px;

        }


        .republic {

            font-size: 10px;

            font-weight: normal;

            color: #000000 !important;

        }


        .department {

            font-size: 13px;

            font-weight: bold;

            color: #000000 !important;

        }


        .region {

            font-size: 11px;

            font-weight: bold;

            color: #000000 !important;

        }


        .office {

            font-size: 10px;

            font-weight: bold;

            color: #000000 !important;

        }


        .address {

            font-size: 8px;

            margin-top: 2px;

            color: #000000 !important;

        }


        /*
        |--------------------------------------------------------------------------
        | REPORT TITLE
        |--------------------------------------------------------------------------
        */

        .report-title {

            text-align: center;

            font-size: 14px;

            font-weight: bold;

            margin-top: 7px;

            margin-bottom: 2px;

            color: #000000 !important;

        }


        .report-subtitle {

            text-align: center;

            font-size: 10px;

            font-weight: bold;

            margin-bottom: 8px;

            color: #000000 !important;

        }


        /*
        |--------------------------------------------------------------------------
        | MAIN PROJECT TABLE
        |--------------------------------------------------------------------------
        */

        table.project-table {

            width: 100%;

            border-collapse: collapse;

            table-layout: fixed;

            color: #000000 !important;

        }


        /*
        |--------------------------------------------------------------------------
        | COLUMN WIDTHS
        |--------------------------------------------------------------------------
        */

        .project-table .col-id {

            width: 5%;

        }


        .project-table .col-title {

            width: 15%;

        }


        .project-table .col-contract {

            width: 8%;

        }


        .project-table .col-revised {

            width: 10%;

        }


        .project-table .col-contractor {

            width: 12%;

        }


        .project-table .col-engineer {

            width: 10%;

        }


        .project-table .col-date {

            width: 7%;

        }


        .project-table .col-percent {

            width: 6%;

        }


        .project-table .col-balance {

            width: 9%;

        }


        .project-table .col-status {

            width: 5%;

        }


        .project-table .col-slippage {

            width: 6%;

        }


        /*
        |--------------------------------------------------------------------------
        | PROJECT TABLE HEADER
        |--------------------------------------------------------------------------
        */

        .project-table th {

            border: 1px solid #000000;

            background: #e6e6e6;

            padding: 3px 2px;

            text-align: center;

            vertical-align: middle;

            font-size: 6px;

            font-weight: bold;

            line-height: 1.15;

            white-space: normal;

            word-wrap: break-word;

            overflow-wrap: break-word;

            color: #000000 !important;

        }


        /*
        |--------------------------------------------------------------------------
        | PROJECT TABLE DATA
        |--------------------------------------------------------------------------
        */

        .project-table td {

            border: 1px solid #000000;

            padding: 3px 2px;

            vertical-align: middle;

            font-size: 5.8px;

            line-height: 1.2;

            white-space: normal;

            word-wrap: break-word;

            overflow-wrap: break-word;

            color: #000000 !important;

        }


        .text-cell {

            text-align: left;

            white-space: normal;

            word-wrap: break-word;

            overflow-wrap: break-word;

            color: #000000 !important;

        }


        .center {

            text-align: center;

            color: #000000 !important;

        }


        .money {

            text-align: right;

            white-space: normal;

            word-wrap: break-word;

            overflow-wrap: break-word;

            color: #000000 !important;

        }


        .project-id {

            text-align: center;

            font-weight: bold;

            color: #000000 !important;

        }


        .status {

            text-align: center;

            font-weight: bold;

            word-wrap: break-word;

            overflow-wrap: break-word;

            color: #000000 !important;

        }


        /*
        |--------------------------------------------------------------------------
        | SLIPPAGE
        |--------------------------------------------------------------------------
        | Both positive and negative values are BLACK.
        */

        .negative,
        .positive {

            color: #000000 !important;

            font-weight: bold;

        }


        /*
        |--------------------------------------------------------------------------
        | NO DATA
        |--------------------------------------------------------------------------
        */

        .no-data {

            text-align: center;

            padding: 8px;

            font-size: 8px;

            color: #000000 !important;

        }


        /*
        |--------------------------------------------------------------------------
        | MONTHLY COMMITMENT
        |--------------------------------------------------------------------------
        */

        .commitment-heading {

            margin-top: 12px;

            margin-bottom: 5px;

            font-size: 9px;

            font-weight: bold;

            color: #000000 !important;

        }


        table.commitment-table {

            width: 100%;

            border-collapse: collapse;

            table-layout: fixed;

            color: #000000 !important;

        }


        .commitment-table th {

            background: #e6e6e6;

            border: 1px solid #000000;

            padding: 5px;

            text-align: center;

            vertical-align: middle;

            font-size: 7px;

            font-weight: bold;

            color: #000000 !important;

        }


        .commitment-table td {

            border: 1px solid #000000;

            padding: 5px;

            text-align: center;

            vertical-align: middle;

            font-size: 7px;

            color: #000000 !important;

        }


        /*
        |--------------------------------------------------------------------------
        | GENERATED DATE / TIME
        |--------------------------------------------------------------------------
        */

        .generated {

            margin-top: 10px;

            text-align: right;

            font-size: 7px;

            color: #000000 !important;

        }


        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        .footer {

            position: fixed;

            bottom: -3mm;

            left: 0;

            right: 0;

            text-align: center;

            font-size: 6.5px;

            color: #000000 !important;

        }

    </style>

</head>


<body>


{{-- ======================================================================
     OFFICIAL DPWH HEADER
====================================================================== --}}

<div class="official-header">

    <table class="header-table">

        <tr>

            <td class="logo-left">

                @if($dpwhLogo)

                    <img
                        src="{{ $dpwhLogo }}"
                        class="logo"
                        alt="DPWH Logo"
                    >

                @endif

            </td>


            <td class="header-center">

                <div class="republic">

                    REPUBLIC OF THE PHILIPPINES

                </div>


                <div class="department">

                    DEPARTMENT OF PUBLIC WORKS AND HIGHWAYS

                </div>


                <div class="region">

                    NEGROS ISLAND REGION

                </div>


                <div class="office">

                    REGIONAL OFFICE

                </div>


                <div class="address">

                    Office Address:
                    DPWH Bureau of Equipment 4th Area Equipment Service,
                    Brgy. Bio-os, Amlan, Negros Oriental

                </div>

            </td>


            <td class="logo-right">

                @if($bagongPilipinasLogo)

                    <img
                        src="{{ $bagongPilipinasLogo }}"
                        class="logo"
                        alt="Bagong Pilipinas Logo"
                    >

                @endif

            </td>

        </tr>

    </table>

</div>



{{-- ======================================================================
     REPORT TITLE
====================================================================== --}}

<div class="report-title">

    DPWH PROJECT ACCOMPLISHMENT REPORT

</div>


<div class="report-subtitle">

    COMMITMENT FOR {{ strtoupper($monitoringMonth) }}

</div>



{{-- ======================================================================
     MAIN PROJECT TABLE
====================================================================== --}}

<table class="project-table">

    <thead>

        <tr>

            <th class="col-id">
                PROJECT<br>ID
            </th>


            <th class="col-title">
                PROJECT<br>TITLE
            </th>


            <th class="col-contract">
                CONTRACT<br>AMOUNT
            </th>


            <th class="col-revised">
                REVISED<br>CONTRACT<br>AMOUNT
            </th>


            <th class="col-contractor">
                CONTRACTOR
            </th>


            <th class="col-engineer">
                PROJECT<br>ENGINEER
            </th>


            <th class="col-date">
                START<br>DATE
            </th>


            <th class="col-date">
                EXPIRY<br>DATE
            </th>


            <th class="col-percent">
                PHYSICAL<br>%
            </th>


            <th class="col-percent">
                FINANCIAL<br>%
            </th>


            <th class="col-balance">
                BALANCE
            </th>


            <th class="col-status">
                STATUS
            </th>


            <th class="col-slippage">
                SLIPPAGE
            </th>

        </tr>

    </thead>


    <tbody>


    @forelse($reportProjects as $project)


        @php

            $contractAmount = (float) (
                $project->contract_amount ?? 0
            );


            $revisedAmount = (float) (
                $project->revised_contract_amount
                ?? $contractAmount
            );


            $physical = (float) (
                $project->physical_accomplishment ?? 0
            );


            $financial = (float) (
                $project->financial_accomplishment ?? 0
            );


            $balance = $revisedAmount -
                (($financial / 100) * $revisedAmount);


            $status = $project->status ?? '—';


            $slippage = (float) (
                $project->slippage ?? 0
            );

        @endphp


        <tr>

            <td class="center project-id">

                {{ $project->project_id ?? '—' }}

            </td>


            <td class="text-cell">

                {{ $project->project_title ?? '—' }}

            </td>


            <td class="money">

                ₱{{ number_format(
                    $contractAmount,
                    2
                ) }}

            </td>


            <td class="money">

                ₱{{ number_format(
                    $revisedAmount,
                    2
                ) }}

            </td>


            <td class="text-cell">

                {{ $project->contractor ?? '—' }}

            </td>


            <td class="text-cell">

                {{ $project->project_engineer ?? '—' }}

            </td>


            <td class="center">

                @if($project->start_date)

                    {{ \Carbon\Carbon::parse(
                        $project->start_date
                    )->format('M d, Y') }}

                @else

                    —

                @endif

            </td>


            <td class="center">

                @if($project->expiry_date)

                    {{ \Carbon\Carbon::parse(
                        $project->expiry_date
                    )->format('M d, Y') }}

                @else

                    —

                @endif

            </td>


            <td class="center">

                {{ number_format(
                    $physical,
                    2
                ) }}%

            </td>


            <td class="center">

                {{ number_format(
                    $financial,
                    2
                ) }}%

            </td>


            <td class="money">

                ₱{{ number_format(
                    $balance,
                    2
                ) }}

            </td>


            <td class="center status">

                {{ ucfirst($status) }}

            </td>


            <td class="center">

                @if($slippage < 0)

                    <span class="negative">

                        {{ number_format(
                            $slippage,
                            2
                        ) }}%

                    </span>

                @else

                    <span class="positive">

                        {{ number_format(
                            $slippage,
                            2
                        ) }}%

                    </span>

                @endif

            </td>

        </tr>


    @empty


        <tr>

            <td
                colspan="13"
                class="no-data"
            >

                No project records found.

            </td>

        </tr>


    @endforelse


    </tbody>

</table>



{{-- ======================================================================
     MONTHLY COMMITMENT
====================================================================== --}}

<div class="commitment-heading">

    MONTHLY COMMITMENT - {{ $monitoringMonth }}

</div>


<table class="commitment-table">

    <thead>

        <tr>

            <th>
                Commitment Month
            </th>

            <th>
                Planned
            </th>

            <th>
                Actual
            </th>

            <th>
                Slippage
            </th>

            <th>
                Advance Payment
            </th>

            <th>
                Progress / Interim
            </th>

        </tr>

    </thead>


    <tbody>


    @forelse($reportProjects as $project)


        @php

            $planned = (float) (
                $project->planned_accomplishment ?? 0
            );


            $actual = (float) (
                $project->physical_accomplishment ?? 0
            );


            $commitmentSlippage = (float) (
                $project->commitment_slippage
                ?? ($actual - $planned)
            );


            $advancePayment =
                $project->advance_payment ?? null;


            $progressInterim =
                $project->progress_interim ?? null;

        @endphp


        <tr>

            <td>

                {{ $monitoringMonth }}

            </td>


            <td>

                {{ number_format(
                    $planned,
                    2
                ) }}%

            </td>


            <td>

                {{ number_format(
                    $actual,
                    2
                ) }}%

            </td>


            <td>

                {{ number_format(
                    $commitmentSlippage,
                    2
                ) }}%

            </td>


            <td>

                @if(
                    $advancePayment !== null
                    &&
                    $advancePayment !== ''
                )

                    ₱{{ number_format(
                        (float) $advancePayment,
                        2
                    ) }}

                @else

                    —

                @endif

            </td>


            <td>

                @if(
                    $progressInterim !== null
                    &&
                    $progressInterim !== ''
                )

                    ₱{{ number_format(
                        (float) $progressInterim,
                        2
                    ) }}

                @else

                    —

                @endif

            </td>

        </tr>


    @empty


        <tr>

            <td colspan="6">

                No commitment data available.

            </td>

        </tr>


    @endforelse


    </tbody>

</table>



{{-- ======================================================================
     GENERATED DATE AND TIME
====================================================================== --}}

<div class="generated">

    Generated on
    {{ $generatedAt->format('F d, Y h:i A') }}

</div>



{{-- ======================================================================
     FOOTER
====================================================================== --}}

<div class="footer">

    DPWH ProjectHub - Negros Island Region

</div>


</body>

</html>