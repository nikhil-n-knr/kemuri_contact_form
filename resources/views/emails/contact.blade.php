@include('layout.header')

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f9f9f9; padding: 20px; font-family: Arial, sans-serif;">
    <tr>
        <td align="center">
            <table cellpadding="0" cellspacing="0" border="0" width="600" style="background-color: #ffffff; border-radius: 6px; overflow: hidden; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
                <tr>
                    <td style="padding: 30px; text-align: left;">
                        <h2 style="color: #333333; font-size: 22px; margin-bottom: 20px;">New Contact Form Submission</h2>

                        @if (!empty($data['name']))
                            <p style="margin: 10px 0;"><strong>Name:</strong> {{ $data['name'] }}</p>
                        @endif

                        @if (!empty($data['email']))
                            <p style="margin: 10px 0;"><strong>Email:</strong> <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></p>
                        @endif

                        @if (!empty($data['subject']))
                            <p style="margin: 10px 0;"><strong>Subject:</strong> {{ $data['subject'] }}</p>
                        @endif

                        @if (!empty($data['purpose']))
                            <p style="margin: 10px 0;"><strong>Purpose:</strong> {{ ucfirst($data['purpose']) }}</p>
                        @endif

                        @if (!empty($data['short_description']))
                            <p style="margin: 10px 0;"><strong>Short Description:</strong> {{ $data['short_description'] }}</p>
                        @endif

                        @if (!empty($data['contacting_from']))
                            <p style="margin: 10px 0;"><strong>Contacting From:</strong> {{ ucfirst($data['contacting_from']) }}</p>
                        @endif

                        @if (!empty($data['company_name']))
                            <p style="margin: 10px 0;"><strong>Company Name:</strong> {{ $data['company_name'] }}</p>
                        @endif

                        @if (!empty($data['message']))
                            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #dddddd;">
                            <p style="margin: 10px 0;"><strong>Message:</strong></p>
                            <p style="margin: 10px 0; background-color: #f2f2f2; padding: 15px; border-radius: 5px; color: #555555;">
                                {{ $data['message'] }}
                            </p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #f5f5f5; padding: 15px; text-align: center; font-size: 12px; color: #888888;">
                        <p style="margin: 0;">You received this message via KEMURI Contact Form</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

@include('layout.footer')