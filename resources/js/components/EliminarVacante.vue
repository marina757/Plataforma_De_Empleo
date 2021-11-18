<template>
   <button
         class="text-red-600 hover:text-red-900  mr-5"
         @click="eliminarVacante"
         >Eliminar</button>
</template>

<script>
export default {
    props: ['vacanteId'],
    methods: {
        eliminarVacante() {
            // console.log('eliminando...', this.vacanteId)

            this.$swal.fire({
                title: '¿Deseas eliminar esta vacante?',
                text: "Una vez eliminada no se puede recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
                }).then((result) => {
                if (result.value) {

                    //ENVIAR PETICION A AXIOS

                    this.$swal.fire(
                    'Vacante eliminada',
                    'Se elimino correctamente',
                    'success'
                    )
                }
                })
        }
    }
}
</script>
