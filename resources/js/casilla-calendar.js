import { Calendar } from "vanilla-calendar-pro";
import "vanilla-calendar-pro/styles/layout.css";
import "vanilla-calendar-pro/styles/themes/light.css";

const calendarElement = document.querySelector("[data-casilla-calendar]");
const weekSelect = document.querySelector("[data-casilla-week-select]");
const weekPriceElement = document.querySelector("[data-casilla-week-price] strong");

if (calendarElement && weekSelect) {
    const weeks = JSON.parse(calendarElement.dataset.weeks || "[]");
    const padNumber = (value) => String(value).padStart(2, "0");
    const parseDateString = (dateString) => {
        const [year, month, day] = dateString.split("-").map(Number);

        return new Date(Date.UTC(year, month - 1, day));
    };
    const formatDateString = (date) =>
        `${date.getUTCFullYear()}-${padNumber(date.getUTCMonth() + 1)}-${padNumber(date.getUTCDate())}`;
    const addDays = (dateString, days) => {
        const date = parseDateString(dateString);

        date.setUTCDate(date.getUTCDate() + days);

        return formatDateString(date);
    };

    const enumerateWeekDates = (week) => {
        return Array.from({ length: 7 }, (_, offset) => addDays(week.mondayDate, offset));
    };

    const weeksById = new Map(weeks.map((week) => [String(week.id), week]));
    const weeksByDate = new Map();

    weeks.forEach((week) => {
        enumerateWeekDates(week).forEach((date) => {
            weeksByDate.set(date, week);
        });
    });

    const selectableWeeks = weeks.filter((week) => week.estado === "DISPONIBLE");
    const disabledDates = Array.from(
        new Set(
            weeks
                .filter((week) => week.estado !== "DISPONIBLE")
                .flatMap((week) => enumerateWeekDates(week)),
        ),
    );

    const getSelectedWeek = () => weeksById.get(weekSelect.value);
    const getWeekRange = (week) => `${week.mondayDate}:${week.sundayDate}`;
    const getWeekDisplayPosition = (week) => {
        const monday = parseDateString(week.mondayDate);

        return {
            selectedMonth: monday.getUTCMonth(),
            selectedYear: monday.getUTCFullYear(),
        };
    };
    const getCalendarBounds = () => {
        if (!weeks.length) {
            return {};
        }

        return {
            dateMin: weeks[0].mondayDate,
            dateMax: weeks[weeks.length - 1].sundayDate,
        };
    };

    const syncSelect = (week) => {
        if (!week || week.estado !== "DISPONIBLE") {
            return;
        }

        weekSelect.value = String(week.id);
    };
    const syncPrice = (week) => {
        if (!weekPriceElement) {
            return;
        }

        weekPriceElement.textContent =
            typeof week?.precio === "number" || week?.precio ? `${Number(week.precio).toFixed(2)} €` : "-";
    };

    const syncCalendar = (week) => {
        if (!week) {
            return;
        }

        const displayPosition = getWeekDisplayPosition(week);

        calendar.set(
            {
                selectedDates: [getWeekRange(week)],
                selectedMonth: displayPosition.selectedMonth,
                selectedYear: displayPosition.selectedYear,
            },
            { dates: true, month: true, year: true },
        );
    };

    const selectedWeek = (() => {
        const currentWeek = getSelectedWeek();

        return currentWeek?.estado === "DISPONIBLE" ? currentWeek : selectableWeeks[0];
    })();
    const initialDisplayWeek = selectedWeek ?? weeks[0];
    const bounds = getCalendarBounds();
    let calendar;

    /** @type {import("vanilla-calendar-pro").Options} */
    const options = {
        type: "default",
        firstWeekday: 1,
        monthsToSwitch: 1,
        displayDatesOutside: false,
        selectionDatesMode: "multiple-ranged",
        enableMonthChangeOnDayClick: false,
        enableDateToggle: false,
        selectedTheme: "light",
        disableDatesPast: false,
        dateMin: bounds.dateMin,
        dateMax: bounds.dateMax,
        disableDates: disabledDates,
        selectedDates: selectedWeek ? [getWeekRange(selectedWeek)] : [],
        selectedMonth: initialDisplayWeek ? getWeekDisplayPosition(initialDisplayWeek).selectedMonth : undefined,
        selectedYear: initialDisplayWeek ? getWeekDisplayPosition(initialDisplayWeek).selectedYear : undefined,
        onClickDate(self, event) {
            const target = event.target instanceof Element ? event.target : null;
            const date = target?.closest("[data-vc-date]")?.dataset.vcDate;
            const week = date ? weeksByDate.get(date) : null;

            if (!week || week.estado !== "DISPONIBLE") {
                return;
            }

            syncSelect(week);
            syncCalendar(week);
            syncPrice(week);
        },
    };

    calendar = new Calendar(calendarElement, options);
    calendar.init();

    if (selectedWeek) {
        syncSelect(selectedWeek);
        syncCalendar(selectedWeek);
        syncPrice(selectedWeek);
    }

    weekSelect.addEventListener("change", () => {
        const week = getSelectedWeek();

        if (!week || week.estado !== "DISPONIBLE") {
            return;
        }

        syncCalendar(week);
        syncPrice(week);
    });
}
