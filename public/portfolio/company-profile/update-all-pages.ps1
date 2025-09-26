# Script PowerShell untuk mengupdate semua halaman HTML PT Bangun Nusantara
$companyProfilePath = "d:\Centrova\landing-page\centrova-retail\public\portfolio\company-profile"

# Daftar file HTML yang akan diupdate
$htmlFiles = @(
    "about.html",
    "contact.html", 
    "services.html",
    "service-single.html",
    "projects.html", 
    "projects-single.html",
    "team.html",
    "testimonials.html",
    "news-left-sidebar.html",
    "news-right-sidebar.html", 
    "news-single.html",
    "pricing.html",
    "faq.html",
    "404.html",
    "typography.html",
    "index-2.html"
)

foreach ($file in $htmlFiles) {
    $filePath = Join-Path $companyProfilePath $file
    
    if (Test-Path $filePath) {
        Write-Host "Updating $file..."
        
        # Baca konten file
        $content = Get-Content $filePath -Raw
        
        # Update title dari Constra ke PT Bangun Nusantara
        $content = $content -replace 'Constra - Construction Html5 Template', 'PT Bangun Nusantara - Perusahaan Konstruksi Terdepan Indonesia'
        
        # Update description
        $content = $content -replace 'Construction Html5 Template', 'PT Bangun Nusantara - Perusahaan Konstruksi Terdepan di Indonesia'
        
        # Update alamat
        $content = $content -replace '9051 Constra Incorporate, USA', 'Jl. Sudirman No. 123, Jakarta Pusat, Indonesia'
        
        # Tambahkan CSS Indonesia theme
        $content = $content -replace '  <link rel="stylesheet" href="css/style.css">', "  <link rel=`"stylesheet`" href=`"css/style.css`">`r`n  <!-- Indonesia Theme -->`r`n  <link rel=`"stylesheet`" href=`"css/indonesia-theme.css`">"
        
        # Update email dan phone di footer jika ada
        $content = $content -replace 'office@Constra.com', 'info@bangunnusantara.co.id'
        $content = $content -replace '\(\+9\) 847-291-4353', '(+62) 21-5550-1234'
        
        # Update alt text untuk logo
        $content = $content -replace 'alt="Constra"', 'alt="PT Bangun Nusantara"'
        
        # Simpan kembali file
        Set-Content $filePath $content -Encoding UTF8
        
        Write-Host "Updated $file successfully!"
    } else {
        Write-Host "File $file not found, skipping..."
    }
}

Write-Host "All files updated successfully!"
