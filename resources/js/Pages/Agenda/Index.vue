<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import allLocales from '@fullcalendar/core/locales-all'
import { ref, onMounted, watch } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
// import { CheckIcon } from '@heroicons/vue/24/outline'

const open = ref(false)

const data = () => {
    return {
        calendarOptions
    }
}

const startHour = '09:00'
const endHour = '20:00'
const intervalAtendece = '00:30'

const daysOfWeek = [1, 2, 3, 4, 5, 6];

// Estado reativo para os dados do novo evento
const newEvent = ref({
    name: '',
    title: '',
    dateStart: '',
    dateEnd: '',
    timeStart: '',
    timeEnd: '',
    interval: intervalAtendece,
})

// Função para buscar eventos do servidor
const fetchEvents = async () => {
    try {
        const response = await axios.get('/api/events')
        calendarOptions.value.events = response.data
    } catch (error) {
        console.error('Erro ao buscar eventos:', error)
    }
}

// Função para adicionar um novo evento
const addEvent = async () => {
    try {
        const response = await axios.post('/api/events', newEvent.value)
        console.log('Evento adicionado:', response.data)
        calendarOptions.value.events.push(response.data)
        // showModal.value = false
        newEvent.value = { name: '', description: '', dateStart: '', dateEnd: '', timeStart: '', timeEnd: '' }
    } catch (error) {
        console.error('Erro ao adicionar evento:', error)
    }
}

// Função para lidar com clique em data
const handleDateClick = (info) => {
    newEvent.value.date = info.dateStr
    filterTimeOptions()
    //   showModal.value = true
    // alert('clicked ' + info.dateStr);
    open.value = true
}

// Função para lidar com seleção de intervalo
const handleSelect = (info) => {
    newEvent.value.dateStart = info.startStr
    newEvent.value.dateEnd = info.endStr
    filterTimeOptions()
    //   showModal.value = true
    // alert('selected ' + info.startStr + ' to ' + info.endStr);
}

const calendarOptions = ref({
    plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
    initialView: 'timeGridDay',
    locales: allLocales,
    locale: 'pt-br',
    dateClick: handleDateClick,
    select: handleSelect,
    slotDuration: intervalAtendece,
    slotMinTime: startHour,
    slotMaxTime: endHour,
    selectable: true,
    selectOverlap: false,
    views: {
        timeGridFourDay: {
        type: 'timeGrid',
        duration: { days: 5 },
        buttonText: '5 dias'
        }
    },
    navLinks: true,
    navLinkDayClick: function(date, jsEvent) {
        console.log('day', date.toISOString());
        console.log('coords', jsEvent.pageX, jsEvent.pageY);
    },
    headerToolbar: {
        center: 'dayGridMonth,timeGridFourDay' // buttons for switching between views
    },
    events: [
        // event data
    ],
    businessHours: {
        startTime: startHour,
        endTime: endHour,
        daysOfWeek: daysOfWeek
    }
});


// Gerar opções de horários das 09:00 às 20:00 em intervalos de 30 minutos
const timeOptions = ref([])
const filteredTimeOptions = ref([])

const generateTimeOptions = () => {
  const startTime = 9 * 60 // 9:00 em minutos
  const endTime = 20 * 60 // 20:00 em minutos
  const interval = 30 // Intervalo de 30 minutos


  for (let time = startTime; time <= endTime; time += interval) {
    const hours = Math.floor(time / 60)
    const minutes = time % 60
    const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`
    timeOptions.value.push(formattedTime)
  }
}

const filterTimeOptions = () => {
    console.log('Filtrando opções de horário...')
  if (!newEvent.value.date) return
  const selectedDate = newEvent.value.date
  const eventsOnSelectedDate = calendarOptions.value.events.filter(event => event.date === selectedDate)
  const bookedTimes = eventsOnSelectedDate.map(event => event.time)

  filteredTimeOptions.value = timeOptions.value.filter(time => !bookedTimes.includes(time))
}


// Buscar eventos quando o componente for montado
onMounted(() => {
    fetchEvents()
    generateTimeOptions()
})

// Recalcular opções de horário quando a data for alterada
watch(() => newEvent.value.date, filterTimeOptions)

</script>

<template>
    <Head title="Agenda" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Agenda</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <FullCalendar :options="calendarOptions" @dateClick="handleDateClick" @select="handleSelect" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <!-- Modal Compromissos -->
    <TransitionRoot as="template" :show="open">
        <Dialog class="relative z-10" @close="open = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel
                            class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                            <div>
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                                    <!-- <CheckIcon class="h-6 w-6 text-green-600" aria-hidden="true" /> -->
                                </div>
                                <div class="mt-3 text-center sm:mt-5">
                                    <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">Agendamento
                                    </DialogTitle>
                                    <div class="mt-2">
                                        <div class="modal-content">
                                            <!-- <span @click="showModal = false" class="close">&times;</span> -->
                                            <form @submit.prevent="addEvent">
                                                <div class="relative my-3">
                                                    <label for="title"
                                                        class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">Nome</label>
                                                    <input type="text" name="title" id="title" v-model="newEvent.title"
                                                        required
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                                </div>

                                                <div class="relative my-4">
                                                    <label for="description"
                                                        class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">Descrição</label>
                                                    <input type="text" name="description" id="description"
                                                        v-model="newEvent.description" required
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                        placeholder="Corte, barba, unha" />
                                                </div>

                                                <div class="relative my-4">
                                                    <label for="date"
                                                        class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">Data</label>
                                                    <input type="date" name="date" id="date" v-model="newEvent.dateStart" required @change="filterTimeOptions"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                                </div>

                                                <div class="relative my-4">
                                                    <label for="time"
                                                        class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">Hora</label>
                                                    <select name="time" id="time" v-model="newEvent.timeStart" required
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                        <option v-for="time in timeOptions" :key="time" :value="time">
                                                            {{ time }}
                                                        </option>
                                                    </select>

                                                </div>

                                                <div
                                                    class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                                    <button type="submit"
                                                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Salvar</button>
                                                    <button type="button"
                                                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0"
                                                        @click="open = false" ref="cancelButtonRef">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
