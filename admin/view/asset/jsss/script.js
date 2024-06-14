const menuLi= document.querySelectorAll(".admin-sidebar-content > ul > li > a")
const subMenu= document.querySelectorAll(".sub-menu")

for (let index = 0; index < menuLi.length; index++) {
    menuLi[index].addEventListener("click",(e) =>{
        e.preventDefault();
        //menuLi[index].parentNode.querySelector('ul').classList.toggle('active')
        for (let i = 0; i < subMenu.length; i++) {
            subMenu[i].setAttribute('style', 'height: 0px')
            
        }
        const submenuHeight= menuLi[index].parentNode.querySelector('ul .sub-menu-item').offsetHeight
        menuLi[index].parentNode.querySelector('ul').setAttribute('style', 'height:' + submenuHeight + 'px')
    })
    
}

// //ảnh chi tiết sản phẩm
// document.getElementById('file').addEventListener('change', function(event) {
//     const imageShow = document.getElementById('image-show');
//     imageShow.innerHTML = ''; // Clear previous image

//     const file = event.target.files[0];
//     if (file) {
//         const reader = new FileReader();
        
//         reader.onload = function(e) {
//             const div = document.createElement('div');
//             div.className = 'image-container';

//             const img = document.createElement('img');
//             img.src = e.target.result;
//             img.width = 150;

//             const btn = document.createElement('button');
//             btn.innerText = 'X';
//             btn.className = 'delete-btn';
//             btn.addEventListener('click', function() {
//                 div.remove();
//                 document.getElementById('file').value = ''; // Clear the input file
//             });

//             div.appendChild(img);
//             div.appendChild(btn);
//             imageShow.appendChild(div);
//         }
        
//         reader.readAsDataURL(file);
//     }
// });

// document.getElementById('files').addEventListener('change', function(event) {
//     const imagesShow = document.getElementById('images-show');
//     imagesShow.innerHTML = ''; // Clear previous images

//     const files = event.target.files;
//     for (let i = 0; i < files.length; i++) {
//         const file = files[i];
//         const reader = new FileReader();
        
//         reader.onload = function(e) {
//             const div = document.createElement('div');
//             div.className = 'image-container';

//             const img = document.createElement('img');
//             img.src = e.target.result;
//             img.width = 150;

//             const btn = document.createElement('button');
//             btn.innerText = 'X';
//             btn.className = 'delete-btn';
//             btn.addEventListener('click', function() {
//                 div.remove();
//                 // Xóa file tương ứng trong input file
//                 const dt = new DataTransfer();
//                 for (let j = 0; j < files.length; j++) {
//                     if (j !== i) {
//                         dt.items.add(files[j]);
//                     }
//                 }
//                 document.getElementById('files').files = dt.files;
//             });

//             div.appendChild(img);
//             div.appendChild(btn);
//             imagesShow.appendChild(div);
//         }
        
//         reader.readAsDataURL(file);
//     }
// });
//định dạng giá
document.addEventListener('DOMContentLoaded', function() {
    function formatCurrency(input) {
        // Xóa các dấu phân cách trước khi định dạng lại
        let value = input.value.replace(/\./g, '');
        // Định dạng lại giá trị
        value = new Intl.NumberFormat('vi-VN').format(value);
        input.value = value;
    }

    const giaBanInput = document.getElementById('gia-ban');
    const giaCuInput = document.getElementById('gia-cu');

    giaBanInput.addEventListener('input', function() {
        formatCurrency(giaBanInput);
    });

    giaCuInput.addEventListener('input', function() {
        formatCurrency(giaCuInput);
    });
});
//add sản phẩm
document.addEventListener('DOMContentLoaded', function() {
    function formatCurrency(input) {
        // Xóa các dấu phân cách trước khi định dạng lại
        let value = input.value.replace(/\./g, '');
        // Định dạng lại giá trị
        value = new Intl.NumberFormat('vi-VN').format(value);
        input.value = value;
    }

    const giaBanInput = document.getElementById('gia-ban');
    const giaCuInput = document.getElementById('gia-cu');

    giaBanInput.addEventListener('input', function() {
        formatCurrency(giaBanInput);
    });

    giaCuInput.addEventListener('input', function() {
        formatCurrency(giaCuInput);
    });

     // Hiển thị ảnh sau khi chọn
     function previewImage(input, previewElementId) {
        const previewContainer = document.getElementById(previewElementId);
        const files = input.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('img-container');
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                
                const removeButton = document.createElement('button');
                removeButton.innerText = 'X';
                removeButton.classList.add('remove-btn');
                removeButton.onclick = function() {
                    imgContainer.remove();
                };

                imgContainer.appendChild(img);
                imgContainer.appendChild(removeButton);
                previewContainer.appendChild(imgContainer);
            }
            reader.readAsDataURL(file);
        }
    }

    const fileInput = document.getElementById('file');
    const filesInput = document.getElementById('files');

    fileInput.addEventListener('change', function() {
        previewImage(fileInput, 'image-show');
    });

    filesInput.addEventListener('change', function() {
        previewImage(filesInput, 'images-show');
    });
});
function deleteImage(imagePath) {
    if (confirm('Bạn có chắc muốn xoá ảnh này?')) {
        // Gửi yêu cầu AJAX đến server để xoá ảnh
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_image.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Xoá phần tử ảnh khỏi DOM sau khi xoá thành công trên server
                const imageContainers = document.querySelectorAll('.image-container');
                imageContainers.forEach(container => {
                    if (container.querySelector('img').src.includes(imagePath)) {
                        container.remove();
                    }
                });
            }
        };
        xhr.send('image=' + encodeURIComponent(imagePath));
    }
}
//lọc
document.querySelector('select[name="category"]').addEventListener('change', function() {
    document.getElementById('filterForm').submit();
});