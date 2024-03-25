<template>
  <div
      class="px-0 mb-[14px]"
      :class="{'!mb-0':index === block.pb_option.length - 1},blocks.blockWidth[arrayKey][index].setBlockWidth+' '+blocks.blockWidth[arrayKey][index].lastHalf"
      v-for="(option,index) in block.pb_option"
      :key="index">
    <a :href="blocks.blockLinks[index]" target="_blank"
       class="d-flex px-2 flex-nowrap overflow-hidden text-nowrap flex-row-reverse rounded-[8px] items-center h-[44px] border-1 !border-b-2 border-black w-full justify-between">
      <i class="ez ez-Apple-Music-solid col-auto"></i>
      <span class="font-shabnam-medium-fd col-auto max-w-[90%] text-truncate">
          {{ blocks.blockTitles[arrayKey][index] }}
        </span>
    </a>
  </div>
</template>

<script>
export default {
  name : "PbOptions",
  props: {
    blocks  : null,
    block   : null,
    arrayKey: null
  },
}
</script>

<style scoped lang="scss">

</style>