<x-userlayout>
  <head>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <style>
     <style>
  * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .home-container {
        max-width: 1600px;
        margin: 0 auto;
        padding: 20px;
        padding-right: 0;
    }

    .home-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .search-box {
      display: flex;
      align-items: center;
      background-color: #fff;
      padding: 8px 12px;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    .search-box input {
      border: none;
      outline: none;
      font-size: 16px;
      margin-right: 8px;
    }

    .book-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-gap: 20px;
    }

    .book-card {
      background-color: #fff;
      padding: 16px;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
    }

    .book-card img {
      max-width: 100%;
      height: auto;
      margin-bottom: 12px;
      border-radius: 8px;
    }

    .book-card h3 {
      font-size: 18px;
      margin-bottom: 8px;
    }

    .book-card p {
      font-size: 14px;
      color: #666;
    }

    .swiper-container {
        width: 100%;
        height: 40%;
        margin-bottom: 20px;
        overflow: hidden;
        aspect-ratio: 3 / 1;
    }

    .swiper-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 8px;
    }

    .swiper-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 8px;
    }

    /* Custom styles for the card container */
    .book-cover {
        width: 100%;
        max-height: 250px;
        object-fit: contain;
        margin: 0 auto;
        border-radius: 8px;
        padding: 10px;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
    }

    .btn-success {
        margin-top: auto;
        padding: 8px 16px;
    }

    .btn-sm {
        font-size: 0.875rem;
    }
    #search-suggestions {
    max-height: 300px;
    overflow-y: auto;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: white;
    border: 1px solid #ccc;
    z-index: 10;
    width: 100%;
    padding: 0;
    margin: 0;
  }
  .suggestion-item {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    border-bottom: 1px solid #f0f0f0;
  }

  .suggestion-item img {
    width: 100px;
    height: 100%;
    margin-right: 3px;
    object-fit: cover;
    border-radius: 8px;
    padding: 3px;
  }

  .suggestion-item div {
    display: flex;
    flex-direction: column;
    justify-content: center;
    flex-grow: 1;
  }

  .suggestion-item h3 {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
  }

  .suggestion-item p {
    font-size: 12px;
    color: gray;
  }

  .suggestion-item:hover {
    background-color: #f0f0f0;
    cursor: pointer;
  }

</style>
  </head>
  <body>
    <div class="home-container">
      <div class="home-header">
        <h1>WELCOME</h1>
        <div class="search-box relative">
          <input type="text" id="search-input" placeholder="Find the book you like..."
                 class="border border-gray-300 rounded px-4 py-2 w-full" autocomplete="off" />
                 <ul id="search-suggestions" class="absolute bg-white border border-gray-300 rounded shadow-lg w-full max-h-48 overflow-auto hidden">
              </ul>
        </div>
    </div>

      <!-- Slider Section -->
      <div class="swiper-container my-slider">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="{{ asset('images/Image_login.jpg') }}" alt="Banner 1" />
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('images/LibraryImage.jpg') }}" alt="Banner 2" />
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('images/LibraryImage2.jpg') }}" alt="Banner 3" />
          </div>
        </div>
      </div>

      <h2>Book Recommendation</h2>
      <div class="book-grid">
          @foreach ($books as $book)
              <div class="book-card">
             
                  <a href="{{ route('user.book', $book->id) }}" class="text-decoration-none text-dark">
                      <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="book-cover" />
                  </a>
                  <div class="card-body text-center flex-grow-1">
                      <a href="{{ route('user.book', $book->id) }}" class="text-decoration-none text-dark">
                          <h3>{{ $book->title }}</h3>
                          <p>{{ $book->author }}</p>
                      </a>
                  </div>
                  <form action="{{ route('users.add_to_borrow_list') }}" method="POST" class="d-flex justify-content-center mt-auto">
                      @csrf
                      <input type="hidden" name="book_id" value="{{ $book->id }}">
                      <input type="hidden" name="quantity" value="1">
                      <button type="submit" class="btn btn-success btn-sm">Add</button>
                  </form>
              </div>
          @endforeach
      </div>
    </div>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".my-slider", {
      loop: true, 
      autoplay: {
        delay: 3000, 
        disableOnInteraction: false,
      },
    });
  });


  document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('search-input');
  const suggestionsBox = document.getElementById('search-suggestions');

  searchInput.addEventListener('input', function () {
    const query = this.value.trim();
    if (query.length > 0) {
      fetch(`/member/search?search=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(books => {
          suggestionsBox.innerHTML = ''; 
          if (books.length > 0) {
            books.forEach(book => {
              const suggestionItem = document.createElement('li');
              suggestionItem.className = 'suggestion-item flex p-2 hover:bg-gray-200 cursor-pointer';
              suggestionItem.innerHTML = `
                <a href="/member/book/${book.id}" class="suggestion-item">
                  <img src="/storage/${book.cover_image}" alt="${book.title}">
                  <div>
                    <h3 class="text-sm font-bold">${book.title}</h3>
                    <p class="text-xs text-gray-500">${book.author}</p>
                  </div>
                </a>
              `;
              suggestionsBox.appendChild(suggestionItem);
            });
            suggestionsBox.classList.remove('hidden'); 
          } else {
            suggestionsBox.innerHTML = '<li class="p-2 text-gray-500">Not Found Result</li>';
            suggestionsBox.classList.remove('hidden');
          }
        })
        .catch(error => {
          console.error('Lỗi khi tìm kiếm:', error);
        });
    } else {
      suggestionsBox.classList.add('hidden'); 
    }
  });

  document.addEventListener('click', function (e) {
    if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
      suggestionsBox.classList.add('hidden');
    }
  });
});
    </script>
  </body>
</x-userlayout>
