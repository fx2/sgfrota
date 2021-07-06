<html>
    <head>
        <style>
            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
            }

            .borda {
                border: 0.1px solid black;
                border-collapse: collapse;
            }

            .text-center{text-align: center;}
            .text-justify {
                text-align: justify;
                text-justify: inter-word;
            }
            .text-justify-left {
                text-align: justify;
                text-justify: inter-word;
                margin-left: 55px;
            }
            .assinatura {
                margin-left: 525px;
            }

            .table {
                width: 100%;
            }

            .page:after {
            content: counter(page, decimal);
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <table width="100%">
                <thead>
                    <th></th>
                </thead>
                <tbody>
                    <tr style="text-align: center;">
                        <td><img src="{{ public_path('images/headerprintPDF.png') }}" width="40%" height="100%"/></td>
                    </tr>
                </tbody>
            </table>
        </header>

        <footer>
            <table width="100%">
                <th>
                    <p class="page">Rua Rodrigues Alves, 51, Jardim Albino Neves Arujá/SP - 07400-575 PABX: (11) 4652-7000</p>
                    <p class="page">Page </p>
                </th>
            </table>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <p></p>
            @yield('content')

            {{-- <p style="page-break-after: always;"> como quebrar paginas
                Content Page 1
            </p>
            <p style="page-break-after: never;">
                Content Page 1
            </p>
            <p style="page-break-after: always;">
                Content Page 1
            </p>
            <p style="page-break-after: never;">
                Content Page 2
            </p> --}}
        </main>
    </body>
</html>
