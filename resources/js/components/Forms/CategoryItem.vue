<template>
    <div>
        <button
            @click="
                selectCategory({
                    id: category.id,
                    parent_id: category.parent_id,
                    name: category.name,
                })
            "
            class="text-white h-10 inline-flex items-center justify-center px-4 font-bold border rounded-full focus:outline-none"
            :class="'bg-indigo-' + validateClass(category)"
        >
            {{ category.name }}
        </button>

        <span class="" v-if="selected && category.children">
            ⏭️
            <!-- <b-icon icon="arrow-right" scale="1"></b-icon>  ⏭️ -->
            <!-- :color="adjust(color, -20)"-->
            <span
                class="list-complete-item"
                v-for="child in category.children"
                :key="child.id"
            >
                <!--v-show="checkIfShow(child.id)" -->
                <CategoryItem
                    @selected_category="selectCategory($event)"
                    :category="child"
                    :list="list"
                    :childLimit="childLimit"
                />
            </span>
            <br />
        </span>
    </div>
</template>
<script>
//import Feeling from "@/components/forms/Feeling.vue";
export default {
    name: "Feeling",
    props: ["category", "list", "childLimit"],
    components: {
        //Feeling,
    },
    data() {
        return {};
    },
    computed: {
        selected: {
            get() {
                return this.list.find((el) => el.id == this.category.id)
                    ? true
                    : false;
            },
            set(value) {
                return value;
            },
        },
        checkIfShow() {
            if (!this.category.parent_id) return true;
            const found = this.list.find(
                (obj) => obj.id === this.category.id && obj.parent_id != null
            );
            const thisCatBrothers = this.list.filter(
                (obj) =>
                    obj.parent_id === this.category.parent_id &&
                    obj.parent_id != null
            );
            if (thisCatBrothers.length < this.childLimit) {
                //console.log('all');
                return true;
            } else if (found) {
                //console.log('show me');
                return true;
            } else {
                //console.log('Hide');
                return false;
            }
        },
    },
    methods: {
        validateClass(obj) {
            if (!obj.parent_id) return "400";
            if (obj.children) return "600";
            else return "800";
        },
        selectCategory(obj) {
            // anda solo en la primer vuelta, para los grandparents
            this.selected = !this.selected;
            //this.currentObj = obj;
            this.$emit("selected_category", obj); //o para evitar el bind ,,, JSON.parse(JSON.stringify(obj))
        },
    },
    mounted() {
        //const feelInForm = this.list.find((el) => el.id == this.feeling.id);
        //console.log(feelInForm);
    },
};
</script>
<style scoped>
/*
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
*/
</style>
