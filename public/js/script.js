const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})

// document.querySelector('#profile-btn').addEventListener('click', function(e) {
//     e.preventDefault();
//     let menu = document.querySelector('#profile-menu');
//     menu.style.display = menu.style.display === 'none' || menu.style.display === '' ? 'block' : 'none';
// });

// // Menutup dropdown ketika klik di luar area
// document.addEventListener('click', function(event) {
//     let menu = document.querySelector('#profile-menu');
//     if (!menu.contains(event.target) && !document.querySelector('#profile-btn').contains(event.target)) {
//         menu.style.display = 'none';
//     }
// });



document.addEventListener('DOMContentLoaded', function() {
    // Get the elements for the profile bar button and the dropdown menu
    const profileBarBtn = document.querySelector('#profile-bar-btn');
    const profileBarMenu = document.querySelector('#profile-bar-menu');

    // Toggle dropdown menu visibility on profile bar button click
    profileBarBtn.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default link behavior
        // Toggle visibility of the dropdown menu
        profileBarMenu.style.display = profileBarMenu.style.display === 'none' || profileBarMenu.style.display === '' ? 'block' : 'none';
    });

    // Hide the dropdown if clicking outside of it
    document.addEventListener('click', function(event) {
        if (!profileBarMenu.contains(event.target) && !profileBarBtn.contains(event.target)) {
            profileBarMenu.style.display = 'none';
        }
    });
});
