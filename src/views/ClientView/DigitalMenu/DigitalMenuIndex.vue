<template>
  <div class="header fixed-top max-w-p mx-auto bg-sec-color h-[54px] content-center rounded-b-[8px]" dir="rtl">
    <div class="row relative mx-auto justify-between flex-nowrap">
      <div class="col-auto self-center">
        <div class="row p-0 flex-nowrap">
          <span class="col-auto px-[32px] self-center">
            <img src="/assets/img/darkMode/sidebarHambergery.svg" alt="">
          </span>
        </div>
      </div>
      <span class="col-auto p-0 text-[20px] text-d8 absolute left-1/2 -top-[3px] translate-middle-x">
            {{ $t('DigitalMenu.Index.Header') }}
      </span>
      <div class="col-auto self-center">
        <div class="row p-0 flex-nowrap">
          <span class="col-auto mr-auto px-[32px]" @click.prevent="$router.go(-1)">
            <img src="/assets/img/darkMode/HeaderBack.svg"
                 alt="">
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="mainContent mt-5">
    <div v-if="!DigitalMenus" class="noContent -z-10 text-center absolute left-1/2 top-1/2 translate-middle">
      <img src="/assets/img/digitalMenu/no-content-digital-menu.svg" class="mb-[50px] mx-auto" alt="">
      <span class="text-[20px] text-d8">
        {{ $t('DigitalMenu.Index.noContent') }}
      </span>
    </div>
    <div class="p-[24px]" v-else>
      <div class="bg-sec-color rounded-[16px] my-3 p-2">
        <div class="row mx-auto flex-nowrap">
          <span class="col-11 p-0 self-center">
          <div class="row flex-nowrap mx-auto shadow-3d p-1 overflow-hidden rounded-[7px]">
          <span class="col-auto p-0 copySvg">
            <svg width="18" height="22" fill="#fff" viewBox="0 0 18 22" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M17.4441 7.35163C17.4441 5.82951 16.2102 4.59558 14.688 4.59558H7.33856C5.81645 4.59558 4.58252 5.82951 4.58252 7.35163V18.3758C4.58252 19.898 5.81645 21.1318 7.33856 21.1318H14.688C16.2102 21.1318 17.4441 19.898 17.4441 18.3758V7.35163ZM15.6067 7.35163C15.6067 6.84426 15.1954 6.43294 14.688 6.43294H7.33856C6.83119 6.43294 6.41988 6.84426 6.41988 7.35163V18.3758C6.41988 18.8832 6.83119 19.2945 7.33856 19.2945H14.688C15.1954 19.2945 15.6067 18.8832 15.6067 18.3758V7.35163Z"/>
              <path
                  d="M3.66376 2.75826H12.8506C13.358 2.75826 13.7693 2.34695 13.7693 1.83958C13.7693 1.33221 13.358 0.920898 12.8506 0.920898H3.66376C2.14164 0.920898 0.907715 2.15483 0.907715 3.67694V16.5385C0.907715 17.0459 1.31903 17.4572 1.8264 17.4572C2.33377 17.4572 2.74508 17.0459 2.74508 16.5385V3.67694C2.74508 3.16957 3.15639 2.75826 3.66376 2.75826Z"/>
            </svg>
          </span>
            <span class="col-auto shareSvg">
            <svg width="18" height="21" viewBox="0 0 18 21" fill="#fff" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M14.4359 0.348877C12.5621 0.348877 11.0431 1.86791 11.0431 3.74173C11.0431 3.94626 11.0611 4.14654 11.0959 4.34109L6.15727 7.79811C6.13217 7.81567 6.10842 7.83444 6.08604 7.85428C5.51004 7.40338 4.78459 7.13459 3.99637 7.13459C2.12254 7.13459 0.603516 8.65365 0.603516 10.5274C0.603516 12.4012 2.12254 13.9203 3.99637 13.9203C4.78459 13.9203 5.51004 13.6515 6.08604 13.2006C6.10842 13.2204 6.13217 13.2392 6.15727 13.2568L11.0959 16.7138C11.0611 16.9083 11.0431 17.1087 11.0431 17.3132C11.0431 19.187 12.5621 20.706 14.4359 20.706C16.3097 20.706 17.8288 19.187 17.8288 17.3132C17.8288 15.4394 16.3097 13.9203 14.4359 13.9203C13.3369 13.9203 12.3598 14.4429 11.7398 15.2531L7.06358 11.9797C7.2724 11.5395 7.38923 11.0471 7.38923 10.5274C7.38923 10.0078 7.2724 9.51544 7.06358 9.0752L11.7398 5.80177C12.3598 6.61201 13.3369 7.13459 14.4359 7.13459C16.3097 7.13459 17.8288 5.61556 17.8288 3.74173C17.8288 1.86791 16.3097 0.348877 14.4359 0.348877ZM12.609 3.74173C12.609 2.73275 13.4269 1.91481 14.4359 1.91481C15.4449 1.91481 16.2629 2.73275 16.2629 3.74173C16.2629 4.75072 15.4449 5.56866 14.4359 5.56866C13.4269 5.56866 12.609 4.75072 12.609 3.74173ZM3.99637 8.70053C2.98739 8.70053 2.16945 9.51846 2.16945 10.5274C2.16945 11.5364 2.98739 12.3544 3.99637 12.3544C5.00536 12.3544 5.8233 11.5364 5.8233 10.5274C5.8233 9.51846 5.00536 8.70053 3.99637 8.70053ZM14.4359 15.4862C13.4269 15.4862 12.609 16.3042 12.609 17.3132C12.609 18.3221 13.4269 19.1401 14.4359 19.1401C15.4449 19.1401 16.2629 18.3221 16.2629 17.3132C16.2629 16.3042 15.4449 15.4862 14.4359 15.4862Z"
                    fill="white"/>
            </svg>
          </span>
            <span class="col-auto p-0 verticalPipe"></span>
            <span class="col-auto p-0 !pl-2 ezyLink text-d8">
            {{ ezyLink }}
          </span>
          </div>
        </span>
          <span class="col-1 p-0 self-center">
          <svg width="33" height="34" viewBox="0 0 33 34" fill="#fff" class="ml-auto"
               xmlns="http://www.w3.org/2000/svg">
            <circle cx="16.8133" cy="17.0054" r="1.34844" transform="rotate(-90 16.8133 17.0054)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
            <circle cx="16.8133" cy="25.0961" r="1.34844" transform="rotate(-90 16.8133 25.0961)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
            <circle cx="16.8133" cy="8.91474" r="1.34844" transform="rotate(-90 16.8133 8.91474)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
          </svg>
        </span>
        </div>
        <div class="mt-[16px] text-center">
          <img src="/assets/img/PageBuilder/userGray.png"
               class="mx-auto object-cover w-[95px] h-[95px] shadow-3d rounded-full" alt="">
          <h1 class="text-[19px] mt-1 text-d8">امید</h1>
          <p class="text-[16px] text-d8">برنامه نویس وب</p>
        </div>
        <div class="row flex-nowrap w-full mx-auto mt-[40px] gap-3 justify-between">
          <a
              class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 text-right px-0 mb-[8px] py-3 bg-sec-color rounded-[8px] shadow-3d text-d8">
            پیش نمایش
            <img src="/assets/img/digitalMenu/previewDigitalMenu.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
          </a>
          <a
              class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 text-right px-0 mb-[8px] py-3 bg-sec-color rounded-[8px] shadow-3d text-d8">
            ویرایش منو
            <img src="/assets/img/digitalMenu/editDigitalMenu.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
          </a>
        </div>
      </div>
      <div class="bg-sec-color rounded-[16px] my-3 p-2">
        <div class="row mx-auto flex-nowrap">
          <span class="col-11 p-0 self-center">
          <div class="row flex-nowrap mx-auto shadow-3d p-1 overflow-hidden rounded-[7px]">
          <span class="col-auto p-0 copySvg">
            <svg width="18" height="22" fill="#fff" viewBox="0 0 18 22" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M17.4441 7.35163C17.4441 5.82951 16.2102 4.59558 14.688 4.59558H7.33856C5.81645 4.59558 4.58252 5.82951 4.58252 7.35163V18.3758C4.58252 19.898 5.81645 21.1318 7.33856 21.1318H14.688C16.2102 21.1318 17.4441 19.898 17.4441 18.3758V7.35163ZM15.6067 7.35163C15.6067 6.84426 15.1954 6.43294 14.688 6.43294H7.33856C6.83119 6.43294 6.41988 6.84426 6.41988 7.35163V18.3758C6.41988 18.8832 6.83119 19.2945 7.33856 19.2945H14.688C15.1954 19.2945 15.6067 18.8832 15.6067 18.3758V7.35163Z"/>
              <path
                  d="M3.66376 2.75826H12.8506C13.358 2.75826 13.7693 2.34695 13.7693 1.83958C13.7693 1.33221 13.358 0.920898 12.8506 0.920898H3.66376C2.14164 0.920898 0.907715 2.15483 0.907715 3.67694V16.5385C0.907715 17.0459 1.31903 17.4572 1.8264 17.4572C2.33377 17.4572 2.74508 17.0459 2.74508 16.5385V3.67694C2.74508 3.16957 3.15639 2.75826 3.66376 2.75826Z"/>
            </svg>
          </span>
            <span class="col-auto shareSvg">
            <svg width="18" height="21" viewBox="0 0 18 21" fill="#fff" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M14.4359 0.348877C12.5621 0.348877 11.0431 1.86791 11.0431 3.74173C11.0431 3.94626 11.0611 4.14654 11.0959 4.34109L6.15727 7.79811C6.13217 7.81567 6.10842 7.83444 6.08604 7.85428C5.51004 7.40338 4.78459 7.13459 3.99637 7.13459C2.12254 7.13459 0.603516 8.65365 0.603516 10.5274C0.603516 12.4012 2.12254 13.9203 3.99637 13.9203C4.78459 13.9203 5.51004 13.6515 6.08604 13.2006C6.10842 13.2204 6.13217 13.2392 6.15727 13.2568L11.0959 16.7138C11.0611 16.9083 11.0431 17.1087 11.0431 17.3132C11.0431 19.187 12.5621 20.706 14.4359 20.706C16.3097 20.706 17.8288 19.187 17.8288 17.3132C17.8288 15.4394 16.3097 13.9203 14.4359 13.9203C13.3369 13.9203 12.3598 14.4429 11.7398 15.2531L7.06358 11.9797C7.2724 11.5395 7.38923 11.0471 7.38923 10.5274C7.38923 10.0078 7.2724 9.51544 7.06358 9.0752L11.7398 5.80177C12.3598 6.61201 13.3369 7.13459 14.4359 7.13459C16.3097 7.13459 17.8288 5.61556 17.8288 3.74173C17.8288 1.86791 16.3097 0.348877 14.4359 0.348877ZM12.609 3.74173C12.609 2.73275 13.4269 1.91481 14.4359 1.91481C15.4449 1.91481 16.2629 2.73275 16.2629 3.74173C16.2629 4.75072 15.4449 5.56866 14.4359 5.56866C13.4269 5.56866 12.609 4.75072 12.609 3.74173ZM3.99637 8.70053C2.98739 8.70053 2.16945 9.51846 2.16945 10.5274C2.16945 11.5364 2.98739 12.3544 3.99637 12.3544C5.00536 12.3544 5.8233 11.5364 5.8233 10.5274C5.8233 9.51846 5.00536 8.70053 3.99637 8.70053ZM14.4359 15.4862C13.4269 15.4862 12.609 16.3042 12.609 17.3132C12.609 18.3221 13.4269 19.1401 14.4359 19.1401C15.4449 19.1401 16.2629 18.3221 16.2629 17.3132C16.2629 16.3042 15.4449 15.4862 14.4359 15.4862Z"
                    fill="white"/>
            </svg>
          </span>
            <span class="col-auto p-0 verticalPipe"></span>
            <span class="col-auto p-0 !pl-2 ezyLink text-d8">
            {{ ezyLink }}
          </span>
          </div>
        </span>
          <span class="col-1 p-0 self-center">
          <svg width="33" height="34" viewBox="0 0 33 34" fill="#fff" class="ml-auto"
               xmlns="http://www.w3.org/2000/svg">
            <circle cx="16.8133" cy="17.0054" r="1.34844" transform="rotate(-90 16.8133 17.0054)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
            <circle cx="16.8133" cy="25.0961" r="1.34844" transform="rotate(-90 16.8133 25.0961)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
            <circle cx="16.8133" cy="8.91474" r="1.34844" transform="rotate(-90 16.8133 8.91474)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
          </svg>
        </span>
        </div>
        <div class="mt-[16px] text-center">
          <img src="/assets/img/PageBuilder/demoImg.png"
               class="mx-auto object-cover w-[95px] h-[95px] shadow-3d rounded-full" alt="">
          <h1 class="text-[19px] mt-1 text-d8">امید</h1>
          <p class="text-[16px] text-d8">برنامه نویس وب برنامه نویس وب برنامه نویس وب برنامه نویس وب برنامه نویس وب برنامه نویس وب </p>
        </div>
        <div class="row flex-nowrap w-full mx-auto mt-[40px] gap-3 justify-between">
          <a
              class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 text-right px-0 mb-[8px] py-3 bg-sec-color rounded-[8px] shadow-3d text-d8">
            پیش نمایش
            <img src="/assets/img/digitalMenu/previewDigitalMenu.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
          </a>
          <a
              class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 text-right px-0 mb-[8px] py-3 bg-sec-color rounded-[8px] shadow-3d text-d8">
            ویرایش منو
            <img src="/assets/img/digitalMenu/editDigitalMenu.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
          </a>
        </div>
      </div>
      <div class="bg-sec-color rounded-[16px] my-3 p-2">
        <div class="row mx-auto flex-nowrap">
          <span class="col-11 p-0 self-center">
          <div class="row flex-nowrap mx-auto shadow-3d p-1 overflow-hidden rounded-[7px]">
          <span class="col-auto p-0 copySvg">
            <svg width="18" height="22" fill="#fff" viewBox="0 0 18 22" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M17.4441 7.35163C17.4441 5.82951 16.2102 4.59558 14.688 4.59558H7.33856C5.81645 4.59558 4.58252 5.82951 4.58252 7.35163V18.3758C4.58252 19.898 5.81645 21.1318 7.33856 21.1318H14.688C16.2102 21.1318 17.4441 19.898 17.4441 18.3758V7.35163ZM15.6067 7.35163C15.6067 6.84426 15.1954 6.43294 14.688 6.43294H7.33856C6.83119 6.43294 6.41988 6.84426 6.41988 7.35163V18.3758C6.41988 18.8832 6.83119 19.2945 7.33856 19.2945H14.688C15.1954 19.2945 15.6067 18.8832 15.6067 18.3758V7.35163Z"/>
              <path
                  d="M3.66376 2.75826H12.8506C13.358 2.75826 13.7693 2.34695 13.7693 1.83958C13.7693 1.33221 13.358 0.920898 12.8506 0.920898H3.66376C2.14164 0.920898 0.907715 2.15483 0.907715 3.67694V16.5385C0.907715 17.0459 1.31903 17.4572 1.8264 17.4572C2.33377 17.4572 2.74508 17.0459 2.74508 16.5385V3.67694C2.74508 3.16957 3.15639 2.75826 3.66376 2.75826Z"/>
            </svg>
          </span>
            <span class="col-auto shareSvg">
            <svg width="18" height="21" viewBox="0 0 18 21" fill="#fff" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M14.4359 0.348877C12.5621 0.348877 11.0431 1.86791 11.0431 3.74173C11.0431 3.94626 11.0611 4.14654 11.0959 4.34109L6.15727 7.79811C6.13217 7.81567 6.10842 7.83444 6.08604 7.85428C5.51004 7.40338 4.78459 7.13459 3.99637 7.13459C2.12254 7.13459 0.603516 8.65365 0.603516 10.5274C0.603516 12.4012 2.12254 13.9203 3.99637 13.9203C4.78459 13.9203 5.51004 13.6515 6.08604 13.2006C6.10842 13.2204 6.13217 13.2392 6.15727 13.2568L11.0959 16.7138C11.0611 16.9083 11.0431 17.1087 11.0431 17.3132C11.0431 19.187 12.5621 20.706 14.4359 20.706C16.3097 20.706 17.8288 19.187 17.8288 17.3132C17.8288 15.4394 16.3097 13.9203 14.4359 13.9203C13.3369 13.9203 12.3598 14.4429 11.7398 15.2531L7.06358 11.9797C7.2724 11.5395 7.38923 11.0471 7.38923 10.5274C7.38923 10.0078 7.2724 9.51544 7.06358 9.0752L11.7398 5.80177C12.3598 6.61201 13.3369 7.13459 14.4359 7.13459C16.3097 7.13459 17.8288 5.61556 17.8288 3.74173C17.8288 1.86791 16.3097 0.348877 14.4359 0.348877ZM12.609 3.74173C12.609 2.73275 13.4269 1.91481 14.4359 1.91481C15.4449 1.91481 16.2629 2.73275 16.2629 3.74173C16.2629 4.75072 15.4449 5.56866 14.4359 5.56866C13.4269 5.56866 12.609 4.75072 12.609 3.74173ZM3.99637 8.70053C2.98739 8.70053 2.16945 9.51846 2.16945 10.5274C2.16945 11.5364 2.98739 12.3544 3.99637 12.3544C5.00536 12.3544 5.8233 11.5364 5.8233 10.5274C5.8233 9.51846 5.00536 8.70053 3.99637 8.70053ZM14.4359 15.4862C13.4269 15.4862 12.609 16.3042 12.609 17.3132C12.609 18.3221 13.4269 19.1401 14.4359 19.1401C15.4449 19.1401 16.2629 18.3221 16.2629 17.3132C16.2629 16.3042 15.4449 15.4862 14.4359 15.4862Z"
                    fill="white"/>
            </svg>
          </span>
            <span class="col-auto p-0 verticalPipe"></span>
            <span class="col-auto p-0 !pl-2 ezyLink text-d8">
            {{ ezyLink }}
          </span>
          </div>
        </span>
          <span class="col-1 p-0 self-center">
          <svg width="33" height="34" viewBox="0 0 33 34" fill="#fff" class="ml-auto"
               xmlns="http://www.w3.org/2000/svg">
            <circle cx="16.8133" cy="17.0054" r="1.34844" transform="rotate(-90 16.8133 17.0054)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
            <circle cx="16.8133" cy="25.0961" r="1.34844" transform="rotate(-90 16.8133 25.0961)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
            <circle cx="16.8133" cy="8.91474" r="1.34844" transform="rotate(-90 16.8133 8.91474)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
          </svg>
        </span>
        </div>
        <div class="mt-[16px] text-center">
          <img src="/assets/img/PageBuilder/userGray.png"
               class="mx-auto object-cover w-[95px] h-[95px] shadow-3d rounded-full" alt="">
          <h1 class="text-[19px] mt-1 text-d8">امید</h1>
          <p class="text-[16px] text-d8">برنامه نویس وب</p>
        </div>
        <div class="row flex-nowrap w-full mx-auto mt-[40px] gap-3 justify-between">
          <a
              class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 text-right px-0 mb-[8px] py-3 bg-sec-color rounded-[8px] shadow-3d text-d8">
            پیش نمایش
            <img src="/assets/img/digitalMenu/previewDigitalMenu.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
          </a>
          <a
              class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 text-right px-0 mb-[8px] py-3 bg-sec-color rounded-[8px] shadow-3d text-d8">
            ویرایش منو
            <img src="/assets/img/digitalMenu/editDigitalMenu.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
          </a>
        </div>
      </div>
      <div class="bg-sec-color rounded-[16px] my-3 mb-[10%] p-2">
        <div class="row mx-auto flex-nowrap">
          <span class="col-11 p-0 self-center">
          <div class="row flex-nowrap mx-auto shadow-3d p-1 overflow-hidden rounded-[7px]">
          <span class="col-auto p-0 copySvg">
            <svg width="18" height="22" fill="#fff" viewBox="0 0 18 22" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M17.4441 7.35163C17.4441 5.82951 16.2102 4.59558 14.688 4.59558H7.33856C5.81645 4.59558 4.58252 5.82951 4.58252 7.35163V18.3758C4.58252 19.898 5.81645 21.1318 7.33856 21.1318H14.688C16.2102 21.1318 17.4441 19.898 17.4441 18.3758V7.35163ZM15.6067 7.35163C15.6067 6.84426 15.1954 6.43294 14.688 6.43294H7.33856C6.83119 6.43294 6.41988 6.84426 6.41988 7.35163V18.3758C6.41988 18.8832 6.83119 19.2945 7.33856 19.2945H14.688C15.1954 19.2945 15.6067 18.8832 15.6067 18.3758V7.35163Z"/>
              <path
                  d="M3.66376 2.75826H12.8506C13.358 2.75826 13.7693 2.34695 13.7693 1.83958C13.7693 1.33221 13.358 0.920898 12.8506 0.920898H3.66376C2.14164 0.920898 0.907715 2.15483 0.907715 3.67694V16.5385C0.907715 17.0459 1.31903 17.4572 1.8264 17.4572C2.33377 17.4572 2.74508 17.0459 2.74508 16.5385V3.67694C2.74508 3.16957 3.15639 2.75826 3.66376 2.75826Z"/>
            </svg>
          </span>
            <span class="col-auto shareSvg">
            <svg width="18" height="21" viewBox="0 0 18 21" fill="#fff" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M14.4359 0.348877C12.5621 0.348877 11.0431 1.86791 11.0431 3.74173C11.0431 3.94626 11.0611 4.14654 11.0959 4.34109L6.15727 7.79811C6.13217 7.81567 6.10842 7.83444 6.08604 7.85428C5.51004 7.40338 4.78459 7.13459 3.99637 7.13459C2.12254 7.13459 0.603516 8.65365 0.603516 10.5274C0.603516 12.4012 2.12254 13.9203 3.99637 13.9203C4.78459 13.9203 5.51004 13.6515 6.08604 13.2006C6.10842 13.2204 6.13217 13.2392 6.15727 13.2568L11.0959 16.7138C11.0611 16.9083 11.0431 17.1087 11.0431 17.3132C11.0431 19.187 12.5621 20.706 14.4359 20.706C16.3097 20.706 17.8288 19.187 17.8288 17.3132C17.8288 15.4394 16.3097 13.9203 14.4359 13.9203C13.3369 13.9203 12.3598 14.4429 11.7398 15.2531L7.06358 11.9797C7.2724 11.5395 7.38923 11.0471 7.38923 10.5274C7.38923 10.0078 7.2724 9.51544 7.06358 9.0752L11.7398 5.80177C12.3598 6.61201 13.3369 7.13459 14.4359 7.13459C16.3097 7.13459 17.8288 5.61556 17.8288 3.74173C17.8288 1.86791 16.3097 0.348877 14.4359 0.348877ZM12.609 3.74173C12.609 2.73275 13.4269 1.91481 14.4359 1.91481C15.4449 1.91481 16.2629 2.73275 16.2629 3.74173C16.2629 4.75072 15.4449 5.56866 14.4359 5.56866C13.4269 5.56866 12.609 4.75072 12.609 3.74173ZM3.99637 8.70053C2.98739 8.70053 2.16945 9.51846 2.16945 10.5274C2.16945 11.5364 2.98739 12.3544 3.99637 12.3544C5.00536 12.3544 5.8233 11.5364 5.8233 10.5274C5.8233 9.51846 5.00536 8.70053 3.99637 8.70053ZM14.4359 15.4862C13.4269 15.4862 12.609 16.3042 12.609 17.3132C12.609 18.3221 13.4269 19.1401 14.4359 19.1401C15.4449 19.1401 16.2629 18.3221 16.2629 17.3132C16.2629 16.3042 15.4449 15.4862 14.4359 15.4862Z"
                    fill="white"/>
            </svg>
          </span>
            <span class="col-auto p-0 verticalPipe"></span>
            <span class="col-auto p-0 !pl-2 ezyLink text-d8">
            {{ ezyLink }}
          </span>
          </div>
        </span>
          <span class="col-1 p-0 self-center">
          <svg width="33" height="34" viewBox="0 0 33 34" fill="#fff" class="ml-auto"
               xmlns="http://www.w3.org/2000/svg">
            <circle cx="16.8133" cy="17.0054" r="1.34844" transform="rotate(-90 16.8133 17.0054)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
            <circle cx="16.8133" cy="25.0961" r="1.34844" transform="rotate(-90 16.8133 25.0961)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
            <circle cx="16.8133" cy="8.91474" r="1.34844" transform="rotate(-90 16.8133 8.91474)" stroke="#fff"
                    stroke-width="2.69689" stroke-linecap="round"/>
          </svg>
        </span>
        </div>
        <div class="mt-[16px] text-center">
          <img src="/assets/img/PageBuilder/userGray.png"
               class="mx-auto object-cover w-[95px] h-[95px] shadow-3d rounded-full" alt="">
          <h1 class="text-[19px] mt-1 text-d8">امید</h1>
          <p class="text-[16px] text-d8">برنامه نویس وب</p>
        </div>
        <div class="row flex-nowrap w-full mx-auto mt-[40px] gap-3 justify-between">
          <a
              class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 text-right px-0 mb-[8px] py-3 bg-sec-color rounded-[8px] shadow-3d text-d8">
            پیش نمایش
            <img src="/assets/img/digitalMenu/previewDigitalMenu.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
          </a>
          <a
              class="flex justify-end items-center whitespace-nowrap overflow-hidden col-6 text-right px-0 mb-[8px] py-3 bg-sec-color rounded-[8px] shadow-3d text-d8">
            ویرایش منو
            <img src="/assets/img/digitalMenu/editDigitalMenu.svg" class="d-inline mx-[10px] max-h-[17.5px]" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="bottomAddButton px-[24px] mb-[50px] max-w-p mx-auto fixed-bottom">
    <button :dir="$i18n.locale==='fa'?'rtl':''"
            class="row justify-center bg-pri-color text-sec-color h-[55px] text-[20px] mx-auto w-full rounded-[16px]">
      <span class="col-auto px-[5px] self-center">
      <img src="/assets/img/digitalMenu/create-menu-plus.svg" alt="">
      </span>
      <span class="col-auto px-0 self-center font-shabnam-medium text-sec-color">
      {{ $t('DigitalMenu.Index.AddMenuButton') }}
        </span>
    </button>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "DigitalMenuIndex",
  data() {
    return {
      DigitalMenus: 1,
      ezyLink     : '',
    }
  },
  mounted() {
    this.ezyLink = axios.defaults.baseURL;
    this.ezyLink = this.ezyLink.replace(/(^\w+:|^)\/\//, '');
    this.ezyLink = this.ezyLink.replace('api/', '')
  },
}
</script>

<style>
.verticalPipe:before {
  content: '';
  border-right: 1px white solid;
}

.col-6 {
  flex: 0 0 calc(50% - 0.5rem);
  max-width: calc(50% - 0.5rem);
  text-align: center;
  align-content: end;
  font-size: 14px;
  padding-bottom: 8px;
}</style>