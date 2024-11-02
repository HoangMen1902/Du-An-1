
const city = document.getElementById('city');
const district = document.getElementById('district');

async function fetchProvinces() {
    try {
        const response = await fetch('https://vapi.vnappmob.com/api/province/');

        if (!response.ok) {
            throw new Error(`Lỗi! Status: ${response.status}`);
        }

        const data = await response.json();

        return data.results;

    } catch (error) {
        console.error('Đã có lỗi xảy ra trong quá trình thực thi:', error);
        return [];
    }
}


async function fetchDistricts(provinceId) {
    try {
        const response = await fetch(`https://vapi.vnappmob.com/api/province/district/${provinceId}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        return data.results;
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        return [];
    }
}
async function fetchWards(districtId) {
    try {
        const response = await fetch(`https://vapi.vnappmob.com/api/province/ward/${districtId}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        return data.results;
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        return [];
    }
}


async function updateProvincesDropdown() {
    const provinces = await fetchProvinces();


    city.innerHTML = '<option value="">Tỉnh/Thành</option>';

    provinces.forEach(province => {
        const option = document.createElement('option');
        option.value = province.province_id;
        option.textContent = province.province_name;
        city.appendChild(option);
    });
}





async function updateWardsDropdown(districtId) {
    const wards = await fetchWards(districtId);
    const selectWard = document.getElementById('wards');
    selectWard.innerHTML = '<option value="">Phường/Xã</option>';
    wards.forEach(ward => {
        const option = document.createElement('option');
        option.value = ward.ward_id;
        option.textContent = ward.ward_name;
        selectWard.appendChild(option);
    });
}





async function updateDistrictsDropdown(provinceId) {
    const districts = await fetchDistricts(provinceId);
    const selectDistrict = document.getElementById('district');
    selectDistrict.innerHTML = '<option value="">Quận/Huyện</option>';
    districts.forEach(district => {
        const option = document.createElement('option');
        option.value = district.district_id;
        option.textContent = district.district_name;
        selectDistrict.appendChild(option);
    });
}

document.getElementById('city').addEventListener('change', (event) => {
    const provinceId = event.target.value;
    if (provinceId) {
        updateDistrictsDropdown(provinceId);
    } else {
        document.getElementById('district').innerHTML = '<option value="">Quận/Huyện</option>';
    }
});


document.getElementById('district').addEventListener('change', (event) => {
    const districtId = event.target.value;
    if (districtId) {
        updateWardsDropdown(districtId);
    } else {
        document.getElementById('wards').innerHTML = '<option value="">Phường/xã</option>';
    }
});

updateProvincesDropdown();
// Thằng em ruột 