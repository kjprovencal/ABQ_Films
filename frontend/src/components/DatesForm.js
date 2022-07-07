import { useState } from "react";

export default function DatesForm() {
    const [startDate, setStartDate] = useState("");
    const [endDate, setEndDate] = useState("");

    const handleStartChange = e => setStartDate(e.target.value);
    const handleEndChange = e => setEndDate(e.target.value);
    
    const handleSubmit = e => {
        e.preventDefault();

        const dates = {startDate, endDate};
        const reqOptions = {
            method: "POST",
            mode: 'cors',
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(dates)
        };
        fetch("http://localhost:80/show", reqOptions)
        .then(res => res.json())
        .then(res => console.log(res))
    }

    return (
        <div>
            <h3>Select a start and end date</h3>
            <form>
                <label>Start date:
                    <input type="date" min="2008-01-01" 
                    value = {startDate}
                    onChange={handleStartChange}
                    required/>
                </label>
                <label>End date:
                    <input type="date" max="2015-12-31" 
                    value = {endDate}
                    onChange={handleEndChange}
                    required/>
                </label>
                <input type="submit" value="Submit" onClick={handleSubmit}/>
            </form>
        </div>
    );
}