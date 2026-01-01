// import "./bootstrap";
// import L from "leaflet";
// import "leaflet/dist/leaflet.css";

// import icon from "leaflet/dist/images/marker-icon.png";
// import iconShadow from "leaflet/dist/images/marker-shadow.png";

// delete L.Icon.Default.prototype._getIconUrl;

// L.Icon.Default.mergeOptions({
//     iconUrl: icon,
//     shadowUrl: iconShadow,
// });
import Swal from 'sweetalert2';
window.Swal = Swal;

window.confirmLogout = function () {
    Swal.fire({
        title: 'Logout?',
        text: 'Kamu akan keluar dari akun',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
};
