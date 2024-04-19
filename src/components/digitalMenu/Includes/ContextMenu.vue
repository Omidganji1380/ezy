<template>
  <div class="bottom-0 top-0 left-0 right-0 bg-[#00960610] d-none backdrop-blur-md z-[99999] absolute fade"
       id="contextMenuBackdrop">
  </div>
  <div class="absolute w-[100px] z-[999999] fade d-none" style="left: 0" id="contextMenu">
    <div class="menu">
      <ul class="text-white rounded-xl list-group">
        <li class="px-2 py-1 list-group-item bg-gray-300 list-group-item-action transition-all delay-75 text-gray-600">
          test
        </li>
        <li class="px-2 py-1 list-group-item bg-gray-300 list-group-item-action transition-all delay-75 text-gray-600">
          test
        </li>
        <li class="px-2 py-1 list-group-item bg-gray-300 list-group-item-action transition-all delay-75 text-danger">
          delete
        </li>
      </ul>
    </div>
  </div>

</template>

<script>
import $ from "jquery";

export default {
  name: "ContextMenu",
  props: [
    'contextMenuProfiles','contextOptions'
  ],
  data() {
    return {
      contextSection: null,
    }
  },
  emits:['closeContextMenu'],
  methods: {
    contextMenu(contextMenuProfiles) {
      var menu                = $("#contextMenu");
      var contextMenuBackdrop = $("#contextMenuBackdrop");

      contextMenuProfiles.addEventListener('contextmenu', (e) => {
        contextMenuBackdrop.removeClass('d-none');
        menu.removeClass('d-none');
        setTimeout(() => {
          menu.removeClass('show');
          contextMenuBackdrop.removeClass('show');
        }, 50)
        if (menu.hasClass('show') === false) {
          this.addListenerMulti(contextMenuProfiles, 'touchmove wheel', () => {
            this.closeContextMenu(menu, contextMenuBackdrop, contextMenuProfiles)
          })
          setTimeout(() => {
            contextMenuProfiles.classList.add('relative', 'z-[999999]')
            contextMenuBackdrop.addClass('show');
            menu.addClass('show');
            menu.css({'top': e.clientY + 5 + 'px'})
            menu.css({'left': e.clientX - 50 + 'px'})
            navigator.vibrate([200])
          }, 50)
          window.event.returnValue = false;
        }
      });
      document.addEventListener("click", () => {
        this.closeContextMenu(menu, contextMenuBackdrop, contextMenuProfiles)
      });
    },
    addListenerMulti(element, eventNames, listener) {
      var events = eventNames.split(' ');
      for (var i = 0, iLen = events.length; i < iLen; i++) {
        element.addEventListener(events[i], listener, false);
      }
    },
    closeContextMenu(menu, contextMenuBackdrop, contextMenuProfiles) {
      menu.removeClass('show')
      contextMenuBackdrop.removeClass('show')
      setTimeout(() => {
        contextMenuProfiles.classList.remove('relative', 'z-[999999]')
        menu.addClass('d-none');
        contextMenuBackdrop.addClass('d-none');
        this.$emit('closeContextMenu')
      }, 50)
    },
  },
  mounted() {
    this.contextMenu(this.contextMenuProfiles)
  },
}
</script>

<style scoped lang="scss">

</style>