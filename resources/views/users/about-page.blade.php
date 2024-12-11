<x-userlayout>
    <style>
        main {
          background-color: rgb(206, 229, 248)  
        }

        .text-gray-800 {
        color: #2d3748; /* Màu chữ tối */
        }

        .text-gray-700 {
        color: #4a5568; /* Màu chữ nhẹ */
        }
    </style>
    <main>
        <div class="container mx-auto p-8">
           <div class="text-center mb-8">
              <h1 class="text-3xl font-bold text-gray-900 mb-4">About Us</h1>
              <p class="text-lg text-gray-600">Library DQS - A place offering diverse and high-quality learning resources.</p>
           </div>
     
           <div class="grid md:grid-cols-2 gap-8">
              <!-- Introduction about Library -->
              <div>
                 <h2 class="text-2xl font-semibold text-gray-800 mb-4">Introduction</h2>
                 <p class="text-lg text-gray-700">Library DQS is one of the leading academic resource hubs, designed to provide readers with high-quality materials, books, and research tools. We are committed to supporting learning and intellectual development for people of all ages and fields of study.</p>
              </div>
     
              <!-- Mission & Goals -->
              <div>
                 <h2 class="text-2xl font-semibold text-gray-800 mb-4">Mission & Goals</h2>
                 <ul class="list-disc pl-6 space-y-2">
                    <li class="text-lg text-gray-700">To provide research materials, textbooks, and quality learning resources.</li>
                    <li class="text-lg text-gray-700">To support education and scientific research through online tools and services.</li>
                    <li class="text-lg text-gray-700">To create an academic community where people can exchange knowledge and experiences.</li>
                 </ul>
              </div>
           </div>
     
           <!-- Conclusion -->
           <div class="mt-8">
              <p class="text-lg text-gray-700">We strive to empower individuals and organizations by providing access to a wealth of knowledge and learning opportunities. Thank you for being a part of the Library DQS community!</p>
           </div>
        </div>
     </main>
</x-userlayout>