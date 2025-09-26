// Sidebar builder
fetch('/navigation.json')
  .then(res => res.json())
  .then(data => {
    const sidebar = document.getElementById('sidebar');
    
    for (const [kategori, links] of Object.entries(data)) {
      // Create main category container
      const sectionDiv = document.createElement('div');
      
      // Create main category button
      const sectionButton = document.createElement('button');
      sectionButton.className = 'flex items-center justify-start w-full hover:bg-[#128AEB]/50 p-1 space-x-1 text-left text-neutral-50 rounded-md focus:ring-2 focus:ring-[#128AEB]';
      sectionButton.innerHTML = `
        <svg class="w-4 h-4 transform transition-transform fill-neutral-400" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
        <span>${kategori}</span>
      `;
      
      // Create content container for this category
      const sectionContent = document.createElement('div');
      sectionContent.className = 'mt-1 space-y-1 hidden';
      
      // Process each item in the category
      for (const [title, path] of Object.entries(links)) {
        // Check if this is a nested category (path is an object)
        if (typeof path === 'object' && path !== null) {
          // Create nested category container
          const subSectionDiv = document.createElement('div');
          
          // Create nested category button
          const subSectionButton = document.createElement('button');
          subSectionButton.className = 'flex items-center justify-between w-full px-3 py-2 text-left text-sm text-gray-600 hover:bg-gray-100 rounded-md transition';
          subSectionButton.innerHTML = `
            <span>${title}</span>
            <svg class="w-4 h-4 transform transition-transform" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          `;
          
          // Create content container for nested category
          const subSectionContent = document.createElement('div');
          subSectionContent.className = 'pl-4 mt-1 space-y-1 hidden';
          
          // Add items to nested category
          for (const [subTitle, subPath] of Object.entries(path)) {
            const subItemLink = document.createElement('a');
            subItemLink.href = `/${subPath}`;
            subItemLink.className = `block px-3 py-1 text-sm text-gray-600 hover:bg-gray-100 rounded-md transition ${initialPage === subPath ? 'bg-blue-50 text-blue-600' : ''}`;
            subItemLink.textContent = subTitle;
            subSectionContent.appendChild(subItemLink);
          }
          
          // Toggle nested category visibility
          subSectionButton.addEventListener('click', (e) => {
            e.stopPropagation();
            const icon = subSectionButton.querySelector('svg');
            icon.classList.toggle('rotate-180');
            subSectionContent.classList.toggle('hidden');
          });
          
          subSectionDiv.appendChild(subSectionButton);
          subSectionDiv.appendChild(subSectionContent);
          sectionContent.appendChild(subSectionDiv);
          
          // Expand if current page is in this nested category
          if (Object.values(path).includes(initialPage)) {
            subSectionButton.click();
          }
        } else {
          // Regular link item
          const itemLink = document.createElement('a');
          itemLink.href = `/${path}`;
          itemLink.className = `block pl-8 flex items-center justify-start w-full hover:bg-[#128AEB]/50 p-1 space-x-1 text-left text-neutral-50 rounded-md focus:ring-2 focus:ring-[#128AEB] ${initialPage === path ? 'bg-neutral-900' : ''}`;
          itemLink.textContent = title;
          sectionContent.appendChild(itemLink);
        }
      }
      
      // Toggle main category visibility
      sectionButton.addEventListener('click', () => {
        const icon = sectionButton.querySelector('svg');
        icon.classList.toggle('rotate-180');
        sectionContent.classList.toggle('hidden');
      });
      
      sectionDiv.appendChild(sectionButton);
      sectionDiv.appendChild(sectionContent);
      sidebar.appendChild(sectionDiv);
      
      // Expand category if it contains current page
      const containsCurrentPage = Object.values(links).some(item => 
        typeof item === 'string' ? item === initialPage : 
        Object.values(item).includes(initialPage)
      );
      
      if (containsCurrentPage) {
        sectionButton.click();
      }
    }
  });

// Content loader (unchanged)
function loadPage(slug) {
  const mdPath = `/data/docs/${slug}.md`;

  fetch(mdPath)
    .then(res => {
      if (!res.ok) throw new Error("Dokumen tidak ditemukan.");
      return res.text();
    })
    .then(md => {
      document.getElementById('content').innerHTML = marked.parse(md);
    })
    .catch(err => {
      document.getElementById('content').innerHTML = `<p class="text-red-600">${err.message}</p>`;
    });
}

document.addEventListener("DOMContentLoaded", () => {
  if (typeof initialPage !== "undefined" && initialPage) {
    loadPage(initialPage);
  } else {
    document.getElementById("content").innerHTML = "<p class='text-gray-500'>Silakan pilih dokumentasi dari sidebar.</p>";
  }
});