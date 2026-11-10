<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Users Report</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 12mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            font-size: 22px;
            color: #222;
            margin: 0 0 18px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }

        .users-container {
            width: 100%;
            margin: 0 auto;
        }

        .user-card {
            width: 100%;
            border: 1px solid #bbb;
            border-radius: 6px;
            margin-bottom: 14px;
            padding: 12px;
            page-break-inside: avoid;
            background-color: #fff;
        }

        .card-header {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            background-color: #333;
            color: white;
            padding: 9px;
            margin: -12px -12px 12px;
        }

        .user-details {
            width: 100%;
            display: table;
            table-layout: fixed;
            border-spacing: 8px 5px;
            margin: -5px -8px;
        }

        .detail-row {
            display: table-row;
        }

        .detail {
            display: table-cell;
            width: 50%;
            padding: 8px;
            background-color: #f3f3f3;
            border: 1px solid #ddd;
            vertical-align: middle;
            overflow-wrap: break-word;
        }

        .label {
            font-weight: bold;
            color: #444;
            display: block;
            margin-bottom: 4px;
        }

        .value {
            color: #222;
            display: block;
            overflow-wrap: break-word;
        }

    </style>
</head>

<body>

    <h2>Users Report</h2>

    <div class="users-container">

        @foreach($users as $index => $user)

            <div class="user-card">

                <div class="card-header">
                    User #{{ $index + 1 }}
                </div>

                <div class="user-details">

                    <div class="detail-row">
                        <div class="detail">
                            <span class="label">ID</span>
                            <span class="value">{{ $user->id }}</span>
                        </div>

                        <div class="detail">
                            <span class="label">Name</span>
                            <span class="value">{{ $user->name }}</span>
                        </div>
                    </div>

                    <div class="detail-row">
                        <div class="detail">
                            <span class="label">Email</span>
                            <span class="value">{{ $user->email }}</span>
                        </div>

                        <div class="detail">
                            <span class="label">Age</span>
                            <span class="value">{{ $user->age }}</span>
                        </div>
                    </div>

                    <div class="detail-row">
                        <div class="detail">
                            <span class="label">Country</span>
                            <span class="value">{{ $user->country }}</span>
                        </div>

                        <div class="detail">
                            <span class="label">Gender</span>
                            <span class="value">{{ $user->gender }}</span>
                        </div>
                    </div>

                    <div class="detail-row">
                        <div class="detail">
                            <span class="label">Skills</span>
                            <span class="value">
                                {{ is_array($user->skills) ? implode(', ', $user->skills) : $user->skills }}
                            </span>
                        </div>

                        <div class="detail">
                            <span class="label">Color</span>
                            <span class="value">{{ $user->color }}</span>
                        </div>
                    </div>

                    <div class="detail-row">
                        <div class="detail">
                            <span class="label">Salary</span>
                            <span class="value">{{ $user->salary }}</span>
                        </div>

                        <div class="detail">
                            <span class="label">Record Number</span>
                            <span class="value">{{ $index + 1 }}</span>
                        </div>
                    </div>

                </div>

            </div>

        @endforeach

    </div>

</body>
</html>
