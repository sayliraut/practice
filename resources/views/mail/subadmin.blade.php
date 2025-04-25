<html>
<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />

<head>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap");
        @media only screen and (max-width: 767px) {
            .main {
                width: 100% !important;
            }

            .top-image {
                width: 100% !important;
            }

            .inside-footer {
                width: 320px !important;
            }

            table[class="contenttable"] {
                width: 320px !important;
                text-align: left !important;
            }

            td[class="force-col"] {
                display: block !important;
            }

            td[class="rm-col"] {
                display: none !important;
            }

            .mt {
                margin-top: 15px !important;
            }

            *[class].width300 {
                width: 255px !important;
            }

            *[class].block {
                display: block !important;
            }

            *[class].blockcol {
                display: none !important;
            }

            .emailButton {
                width: 100% !important;
            }

            .emailButton a {
                display: block !important;
                font-size: 18px !important;
            }

            .side p {
                width: 100%;
            }

            td.border {
                width: auto !important;
            }

            tfoot td {
                font-size: 10px;
            }

            .mktEditable p {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 600px) {
            .main {
                width: 320px !important;
            }

            .top-image {
                width: 100% !important;
            }

            .inside-footer {
                width: 320px !important;
            }

            table[class="contenttable"] {
                width: 320px !important;
                text-align: left !important;
            }

            td[class="force-col"] {
                display: block !important;
            }

            td[class="rm-col"] {
                display: none !important;
            }

            .mt {
                margin-top: 15px !important;
            }

            *[class].width300 {
                width: 255px !important;
            }

            *[class].block {
                display: block !important;
            }

            *[class].blockcol {
                display: none !important;
            }

            .emailButton {
                width: 100% !important;
            }

            .emailButton a {
                display: block !important;
                font-size: 18px !important;
            }

            .side p {
                width: 100%;
            }

            td.border {
                width: auto !important;
            }

            tfoot td {
                font-size: 10px;
            }

            .mktEditable p {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <table class="main contenttable"
        style="
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
      ">
        <tbody>
            <tr>
                <td class="border"
                    style="
              display: flex;
              border: 1px solid #9d9a9a !important;
              width: 535px;
            ">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" class="side title">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="head-title"
                                                    style="
                              display: flex;
                              justify-content: center;
                              background-color: #fcf6e4;
                            ">
                                                    <div class="mktEditable" id="main_title">

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                                        <td class="grey-block"
                                                                            style="
                                                    font-family: 'Montserrat', sans-serif;
                                                    padding: 20px 20px 0 20px;
                                                    color: #000;
                                                    font-size: 15px;
                                                    ">
                                                    <div class="mktEditable" id="cta">
                                                        <p style="font-weight: 500">
                                                        </p>
                                                        <p>Dear {{$mailData['username']}},</p>

                                                        <p>Congratulations! Your sub-admin account
                                                            has been successfully approved.</p>

                                                        <p>Your login credentials are as follows:</p>
                                                        <ul>
                                                            <li><strong>User Name:</strong> {{$mailData['username']}}</li>

                                                            <li><strong>Password:</strong> {{$mailData['password']}}</li>
                                                        </ul>

                                                        <p>You can now log in to your sub-admin dashboard to access your
                                                            account .</p>

                                                        <p>If you have any questions or need further assistance, please
                                                            feel free to contact us.</p>
`
                                                        <p>Best regards,<br>Sayli Raut</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</html>
