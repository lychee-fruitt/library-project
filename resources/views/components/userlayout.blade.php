<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <!-- CSS và Font -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Prompt', sans-serif;
            background-color: #f0f8ff; /* Màu nền xanh pastel */
            color: #4a4a4a; /* Màu chữ mềm mại */
        }

        .app-container {
            display: flex;
            flex-wrap: wrap; /* Cho phép phần tử linh động */
            height: 100vh;
        }

        .sidebar {
            width: 220px;
            padding: 20px;
            background-color: #e3f2fd; /* Xanh nhạt pastel */
            border-right: 1px solid #b3d9ff;
            border-radius: 0 12px 12px 0; /* Bo góc mềm mại */
            flex-shrink: 0; /* Ngăn sidebar bị thu nhỏ */
        }

        .sidebar .logo {
            font-size: 24px;
            margin-bottom: 40px;
            color: #0077cc; /* Màu xanh đậm */
            font-weight: bold;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            color: #0056b3; /* Màu xanh nhẹ */
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            border-radius: 8px; /* Bo góc */
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #d0e7ff; /* Hiệu ứng hover */
            color: #003f75;
        }

        .main-content {
            flex: 1;
            padding: 0px;
            overflow-x: hidden;
        }

        header, footer {
            position: sticky;
            top: 0;
            z-index: 1030;
            background-color: #e3f2fd; /* Xanh pastel */
            border-bottom: 1px solid #b3d9ff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        header .user-info i {
            font-size: 1.5rem;
            color: #0077cc;
        }

        header .btn-primary {
            background-color: #0077cc; /* Xanh đậm */
            border-color: #0077cc;
        }

        header .btn-primary:hover {
            background-color: #005bb5; /* Xanh đậm hơn khi hover */
            border-color: #005bb5;
        }

        .logout {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #cc3333; /* Màu đỏ nhẹ */
            font-weight: bold;
            transition: color 0.3s;
        }

        .logout:hover {
            color: #aa0000; /* Hiệu ứng hover */
        }

        nav{
            border-bottom: 3px solid rgb(181, 219, 245);
        }

        footer
             {
                border-top: 1px solid #95c4f3;
                padding: 10px 20px;
                text-align: center;
                display: flex; 
                flex-direction: column; 
                justify-content: center; 
                align-items: center; 
                height: 10%;
                margin-top: 860px;
            }
            footer a {
                color: #0077cc;
                text-decoration: none;
                font-weight: bold;
            }

        /* Media Queries cho màn hình nhỏ hơn */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #b3d9ff;
            }

            .main-content {
                width: 100%;
                padding: 15px;
            }

            header {
                flex-direction: column;
                align-items: flex-start;
            }

            header .user-info {
                margin-bottom: 10px;
            }

            .app-container {
                flex-direction: column;
                height: auto; /* Điều chỉnh chiều cao khi màn hình nhỏ */
            }
        }

        .no-style{
            color: inherit; 
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href ="{{route('users.about')}}" class = "no-style">
                <h1 class="logo">DQS Library</h1>
            </a>
            <nav>
                <ul>
                    <li><a href="{{ route('user.user-dashboard') }}" class="active">
                        <i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li><a href="{{ route('user.category') }}">
                        <i class="fa-solid fa-layer-group"></i> Category</a>
                    </li>
                    <li><a href="{{ route('users.member_library') }}">
                        <i class="fa-solid fa-book"></i> My Library</a>
                    </li>
                </ul>
            </nav>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                
                <a href="#" class="logout" onclick="document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> Log Out
                </a>
            </div>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <!-- User Avatar và Tên -->
                <div class="user-info">        
                    <a href = "{{route('users.edit')}}">
                        <i class="fa-solid fa-user-circle"></i>
                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </a>
                   
                </div>
                
                <!-- Nút Borrow List -->
                <a href="{{ route('users.borrow_list') }}" class="btn btn-primary d-flex align-items-center">
                    <i class="bi bi-book me-2"></i> Borrow List
                </a>
            </header>

            <!-- Render nội dung động -->
            <main class="p-4">
                {{ $slot }}
            </main>
            <footer>
                <p><strong>DQS Library</strong></p>
                <p>Address: 902 No Trang Long, Binh Thanh District, Ho Chi Minh City</p>
                <p>Phone: <a href="tel:098989898">098989898</a> | Email: <a href="mailto:dqslib@gmail.com">dqslib@gmail.com</a></p>
            </footer>
          
        </div>
    </div>
</body>
</html>
