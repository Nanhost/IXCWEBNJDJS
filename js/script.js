// Theme Toggle
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = themeToggle.querySelector('i');
    
    // Check for saved theme or prefer-color-scheme
    const savedTheme = localStorage.getItem('theme') || 
        (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
        document.body.classList.remove('light-mode');
        themeIcon.className = 'fas fa-sun';
        themeToggle.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
    }
    
    // Toggle theme
    themeToggle.addEventListener('click', function() {
        if (document.body.classList.contains('light-mode')) {
            document.body.classList.replace('light-mode', 'dark-mode');
            themeIcon.className = 'fas fa-sun';
            themeToggle.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.replace('dark-mode', 'light-mode');
            themeIcon.className = 'fas fa-moon';
            themeToggle.innerHTML = '<i class="fas fa-moon"></i> Mode Gelap';
            localStorage.setItem('theme', 'light');
        }
    });
    
    // Load members data
    loadMembers();
    loadActivities();
    
    // Modal functionality
    const modal = document.getElementById('memberModal');
    const closeModal = document.querySelector('.close-modal');
    
    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});

// Load members data
function loadMembers() {
    // In a real application, this would be an AJAX call to your PHP backend
    const members = [
        {
            id: 1,
            name: "Ahmad Fauzi",
            role: "anggota",
            photo: "https://via.placeholder.com/300x200/6a11cb/ffffff?text=Ahmad+Fauzi",
            age: 15,
            birthdate: "15-03-2008",
            hobbies: "Basket, Membaca",
            aspirations: "Dokter"
        },
        {
            id: 2,
            name: "Siti Nurhaliza",
            role: "inti",
            photo: "https://via.placeholder.com/300x200/2575fc/ffffff?text=Siti+Nurhaliza",
            age: 14,
            birthdate: "22-07-2009",
            hobbies: "Menyanyi, Melukis",
            aspirations: "Guru"
        },
        {
            id: 3,
            name: "Budi Santoso",
            role: "anggota",
            photo: "https://via.placeholder.com/300x200/6a11cb/ffffff?text=Budi+Santoso",
            age: 15,
            birthdate: "10-11-2008",
            hobbies: "Sepak Bola, Programming",
            aspirations: "Software Engineer"
        }
    ];
    
    const membersGrid = document.getElementById('membersGrid');
    membersGrid.innerHTML = '';
    
    members.forEach(member => {
        const memberCard = document.createElement('div');
        memberCard.className = 'member-card';
        memberCard.innerHTML = `
            <div class="member-img">
                <img src="${member.photo}" alt="${member.name}">
            </div>
            <div class="member-info">
                <h3>${member.name}</h3>
                <span class="member-role ${member.role === 'inti' ? 'role-inti' : 'role-anggota'}">
                    ${member.role === 'inti' ? 'Anggota Inti' : 'Anggota Kelas'}
                </span>
                <p><i class="fas fa-birthday-cake"></i> ${member.age} tahun</p>
            </div>
        `;
        
        memberCard.addEventListener('click', () => showMemberDetails(member));
        membersGrid.appendChild(memberCard);
    });
}

// Load activities data
function loadActivities() {
    const activities = [
        {
            id: 1,
            title: "Study Tour ke Museum",
            date: "15 Oktober 2023",
            image: "https://via.placeholder.com/400x250/2575fc/ffffff?text=Study+Tour",
            description: "Kunjungan edukatif ke museum nasional"
        },
        {
            id: 2,
            title: "Peringatan Hari Guru",
            date: "25 November 2023",
            image: "https://via.placeholder.com/400x250/6a11cb/ffffff?text=Hari+Guru",
            description: "Acara penghormatan untuk para guru"
        },
        {
            id: 3,
            title: "Lomba Olahraga Antar Kelas",
            date: "10 Desember 2023",
            image: "https://via.placeholder.com/400x250/2575fc/ffffff?text=Lomba+Olahraga",
            description: "Kompetisi olahraga tahunan"
        }
    ];
    
    const activitiesGrid = document.getElementById('activitiesGrid');
    activitiesGrid.innerHTML = '';
    
    activities.forEach(activity => {
        const activityCard = document.createElement('div');
        activityCard.className = 'activity-card';
        activityCard.innerHTML = `
            <div class="activity-img">
                <img src="${activity.image}" alt="${activity.title}">
            </div>
            <div class="activity-content">
                <h3>${activity.title}</h3>
                <div class="activity-date">
                    <i class="far fa-calendar"></i> ${activity.date}
                </div>
                <p>${activity.description}</p>
            </div>
        `;
        
        activitiesGrid.appendChild(activityCard);
    });
}

// Show member details in modal
function showMemberDetails(member) {
    const modal = document.getElementById('memberModal');
    const modalContent = document.getElementById('modalContent');
    
    modalContent.innerHTML = `
        <div class="member-details">
            <div class="detail-header">
                <img src="${member.photo}" alt="${member.name}" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 20px;">
                <h2>${member.name}</h2>
                <span class="member-role ${member.role === 'inti' ? 'role-inti' : 'role-anggota'}" style="font-size: 16px; padding: 8px 20px;">
                    ${member.role === 'inti' ? 'Anggota Inti' : 'Anggota Kelas'}
                </span>
            </div>
            <div class="detail-info">
                <div class="info-row">
                    <i class="fas fa-birthday-cake"></i>
                    <div>
                        <h4>Umur</h4>
                        <p>${member.age} tahun</p>
                    </div>
                </div>
                <div class="info-row">
                    <i class="far fa-calendar"></i>
                    <div>
                        <h4>Tanggal Lahir</h4>
                        <p>${member.birthdate}</p>
                    </div>
                </div>
                <div class="info-row">
                    <i class="fas fa-heart"></i>
                    <div>
                        <h4>Hobi</h4>
                        <p>${member.hobbies}</p>
                    </div>
                </div>
                <div class="info-row">
                    <i class="fas fa-star"></i>
                    <div>
                        <h4>Cita-cita</h4>
                        <p>${member.aspirations}</p>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    modal.style.display = 'flex';
              }
