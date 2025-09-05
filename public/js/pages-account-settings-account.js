/**
 * Account Settings - Account
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const deactivateAcc = document.querySelector('#formAccountDeactivation');

    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
      resetFileInput = document.querySelector('.account-image-reset');

    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
        }
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        accountUserImage.src = resetImage;
      };
    }

    let fotoCaminhao = document.getElementById('fotoCaminhaoImg');
    const fileInputCaminhao = document.querySelector('.foto-caminhao-file-input'),
      resetFileInputCaminhao = document.querySelector('.foto-caminhao-image-reset');

    if (fotoCaminhao) {
      const resetFile = fotoCaminhao.src;
      fileInputCaminhao.onchange = () => {
        if (fileInputCaminhao.files[0]) {
          fotoCaminhao.src = window.URL.createObjectURL(fileInputCaminhao.files[0]);
        }
      };
      resetFileInputCaminhao.onclick = () => {
        fileInputCaminhao.value = '';
        fotoCaminhao.src = resetFile;
      };
    }
  })();
});
