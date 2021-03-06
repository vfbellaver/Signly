<style>
    .page-title {
        background-color: #a8a8a8;
        width: 100%;
        text-transform: uppercase;
        font-size: 14pt;
        height: 22pt;
        color: #FFF;
        float: left;
        margin-left: -34pt;
        padding: 8pt 34pt;
    }

    table.table {
        border-collapse: collapse;
    }

    table.table tr th {
        padding: 8pt;
        text-align: left;
    }

    table.table tr td {
        padding: 8pt;
        border-top: 1px solid #e7eaec;
    }

    tr.odd {
        background-color: #F8F8F8;
    }

    tr.even {
        background-color: #ffffff;
    }

    td.notes {
        font-size: 10pt;
        padding: 8pt;
        background-color: #F8F8F8;
    }

    .divider {
        height: 12pt;
        border-top: 1px solid #888888;
    }

    .cover-page {

    }

    .toc-header {
        background-color: #ffffff;
        font-size: 11pt;
    }

    .toc-footer {
        background-color: #ffffff;
    }

    a.mpdf_toc_a {
        text-decoration: none;
        color: black;
    }

    div.mpdf_toc_level_0 {
        font-size: 11pt;
        line-height: 1.5;
        margin-left: 6pt;
        padding-right: 2em;
    }

    span.mpdf_toc_t_level_0 {
        font-weight: bold;
    }

    span.mpdf_toc_p_level_0 {
    }

    .page-header {
        background-color: #ffffff;
    }

    .page-footer {
        background-color: #ffffff;
    }

    .face-page {

    }

    .face-image {
        max-width: 290pt;
        max-height: 190pt;
        vertical-align: top;
    }

    .footer-image {
        max-width: 64px;
        max-height: 64px;
    }

    .footer-content {
        padding-left: 2pt;
        font-size: 10pt;
    }

    .page-number {
        text-align: right;
        vertical-align: middle;
        padding-right: 8px;
    }

    .uppercase {
        text-transform: uppercase;
    }
</style>
<body>

<htmlpageheader name="tocHeader">
    <div class="toc-header">
        <table style="width: 100%;">
            <tr>
                <td></td>
                <td style="text-align: right;">
                    <small>{{$proposalObj->created_at->format('d/m/Y')}}</small>
                </td>
            </tr>
        </table>
    </div>
</htmlpageheader>

<htmlpagefooter name="tocFooter">
    <div class="toc-footer" style="border-top: 1px solid #000000;">
        <table style="width: 100%">
            <tr>
                <td style="width: 92px">
                    <img class="footer-image" src="{{$team['logo']}}"/>
                </td>
                <td class="footer-content">
                    <div>
                        <strong class="uppercase">{{$team['name']}}</strong><br/>
                        {{$team['address']}},
                        <br/>
                        {{$team['city']}}, {{$team['state']}} - {{$team['zipcode']}}
                        <br/>
                        {{$team['phone']}}, {{$team['email']}}
                        <br/>
                    </div>
                </td>
                <td class="page-number" style="width: 64px;"></td>
            </tr>
        </table>
    </div>
</htmlpagefooter>

<htmlpageheader name="pageHeader">
    <div class="page-header">
        <table style="width: 100%">
            <tr>
                <td>{{$user ? $user['email'] : $team['email']}}</td>
                <td style="text-align: right;">
                    <small>{{$proposalObj->created_at->format('d/m/Y')}}</small>
                </td>
            </tr>
        </table>
    </div>
</htmlpageheader>

<htmlpagefooter name="pageFooter">
    <div class="page-footer" style="border-top: 1px solid #888888;">
        <table style="width: 100%">
            <tr>
                <td style="width: 92px">
                    <img class="footer-image" src="{{$team['logo']}}"/>
                </td>
                <td class="footer-content">
                    <div>
                        <strong class="uppercase">{{$team['name']}}</strong><br/>
                        {{$team['address']}},
                        <br/>
                        {{$team['city']}}, {{$team['state']}} - {{$team['zipcode']}}
                        <br/>
                        {{$team['phone']}}
                        <br/>
                    </div>
                </td>
                <td class="page-number" style="width: 64px;">
                    {PAGENO}/{nbpg}
                </td>
            </tr>
        </table>
    </div>
</htmlpagefooter>

<page class="cover-page">
    <br/>
    <table style="width:100%; margin-top: 250pt ">
        <tr>
            <td align="center" class="uppercase" style="font-size: 20pt; color: #888888;">
                Proposal Presented to: <br/>
                <strong style="font-size: 24pt">{{$client['company_name']}}</strong>
            </td>
        </tr>
    </table>
</page>

<tocpagebreak links="on"
              toc-odd-header-name='tocHeader'
              toc-odd-header-value="on"
              toc-margin-top="102"
              toc-odd-margin-left="72"
              toc-odd-footer-name="tocFooter"
              toc-odd-footer-value="on"
              toc-margin-footer="30"
              paging="on"
              resetpagenum="1"
></tocpagebreak>

<setpageheader name="pageHeader" value="on" page="ODD" show-this-page="1"></setpageheader>
<setpagefooter name="pageFooter" value="on" page="ODD"></setpagefooter>

<page class="summary-page">
    <tocentry content="OVERVIEW" level="0"></tocentry>
    <h1 class="page-title">Overview</h1>

    <h3 class="uppercase">Time Range</h3>
    <table width="100%">
        <tr>
            <td>
                {{$proposalObj->from_date->format('m/d/Y')}} - {{$proposalObj->to_date->format('m/d/Y')}}
            </td>
        </tr>
    </table>

    <h3 class="uppercase">Proposed Locations</h3>
    <table width="100%" class="table">
        <thead>
        <tr>
            <th style="width: 92pt">ID</th>
            <th>Label</th>
            <th style="width: 72pt">Type</th>
            <th style="width: 72pt">Dimensions</th>
            <th style="width: 72pt">Price</th>
        </tr>
        </thead>
        <tbody>
        {{$total = 0}}
        @foreach($proposal['billboard_faces'] as $index => $face)
            <tr class="{{$index % 2 ? 'odd' : 'even'}}">
                <td>{{$face['code']}}</td>
                <td>{{$face['label']}}</td>
                <td>{{$face['type']}}</td>
                <td>{{$face['width']}} x {{$face['height']}}</td>
                <td>{{number_format($face['pivot']['price'],0)}}</td>
            </tr>
            {{$total += $face['pivot']['price']}}
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" class="uppercase"
                style="text-align: right; font-size: 14pt; padding: 8pt;">
                Total: <strong>{{number_format($total, 0)}}</strong></td>
        </tr>
        </tfoot>
    </table>
</page>

@foreach($proposal['billboard_faces'] as $index => $face)
    <page class="face-page">
        <pagebreak suppress="off"></pagebreak>
        <tocentry content="{{$face['location']}}" level="0"></tocentry>
        <h1 class="page-title">{{$face['location']}}</h1>
        <br/>
        <table width="100%">
            <tr>
                <td align="center" style="width: 290pt; vertical-align: top;">
                    <img class="face-image" src="{{$face['photo_url']}}"/>
                </td>
                <td align="center" style="width: 290pt;">
                    <img class="face-image" src="{{$face['static_map']}}"/>
                </td>
            </tr>
        </table>
        <h3 class="uppercase">Details</h3>
        <table width="100%" class="vertical-table">
            <tr class="odd">
                <td class="label">ID</td>
                <td class="value">{{$face['code']}}</td>
                <td class="label">Label</td>
                <td class="value">{{$face['label']}}</td>
            </tr>
            <tr class="even">
                <td class="label">Mo. Impressions</td>
                <td class="value">{{$face['monthly_impressions']}}</td>
                <td class="label">Price</td>
                <td class="value">{{number_format($face['pivot']['price'], 0)}}</td>
            </tr>
            <tr class="odd">
                <td class="label">Dimensions</td>
                <td class="value">{{$face['width']}} x {{$face['height']}}</td>
                <td class="label">Type</td>
                <td class="value">{{$face['type']}}</td>
            </tr>
            <tr class="even">
                @if($face['type'] == 'Static')
                    <td class="label">Illuminated</td>
                    <td class="value"
                        colspan="{{$face['is_illuminated'] ? 1 : 3}}">{{$face['is_illuminated'] ? 'Illuminated' : ''}}</td>
                    @if($face['is_illuminated'])
                        <td class="label">Lightson/off</td>
                        <td class="value">{{$face['lights_on']}} - {{$face['lights_off']}}</td>
                    @endif
                @else
                    <td class="label">Max Ads</td>
                    <td class="value">{{$face['max_ads']}}</td>
                    <td class="label">Duration</td>
                    <td class="value">{{$face['duration']}}</td>
                @endif
            </tr>
        </table>
        <br/>
        <div class="divider"></div>
        <table width="100%">
            <tr>
                <td><h3 class="uppercase">Notes</h3></td>
            </tr>
            <tr>
                <td class="notes">{{$face['notes']}}</td>
            </tr>
        </table>
    </page>
@endforeach
</body>