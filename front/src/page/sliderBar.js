import { styled } from '@mui/material/styles';
import Box from '@mui/material/Box';
import Grid from '@mui/material/Grid';
import Typography from '@mui/material/Typography';
import Slider from '@mui/material/Slider';
import MuiInput from '@mui/material/Input';
import VolumeUp from '@mui/icons-material/VolumeUp';
import axios from "axios";
import { useParams } from 'react-router-dom';
import React, { useEffect, useState } from 'react'

const Input = styled(MuiInput)`
  width: 64px;
`;

const MaxPrice = () => {
    const [articles, setArticles] = useState([]);

    let { category } = useParams();

    let maxPrice = 0;

    useEffect(() => {
        async function getArticleData() {
            try {
                const options = {
                    url: 'http://localhost:8000/api/articles',
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json;charset=UTF-8'
                    }
                }
                const response = await axios(options);
                setArticles(response.data);
            }
            catch (error) {
                console.log(error);
            }
        }
        getArticleData();
    }, []);
}

export default function InputSlider() {

    const [value, setValue] = React.useState(9000);

    const handleSliderChange = (event, newValue) => {
        setValue(newValue);
    };

    const handleInputChange = (event) => {
        setValue(event.target.value === '' ? '' : Number(event.target.value));
    };

    const handleBlur = () => {
        if (value < 0) {
            setValue(0);
        } else if (value > 9000) {
            setValue(9000);
        }
    };

    let maxValue = MaxPrice();
    console.log(maxValue)

    return (
        <Box sx={{ width: 300 }}>
            <Grid container spacing={2} alignItems="center">
                <Grid item>
                </Grid>
                <Grid item xs>
                    <Slider
                        value={typeof value === 'number' ? value : 0}
                        onChange={handleSliderChange}
                        aria-labelledby="input-slider"
                        valueLabelDisplay="auto"
                        max='9000'
                    />
                </Grid>
                <Grid item>
                    <Input
                        value={value}
                        onChange={handleInputChange}
                        onBlur={handleBlur}
                        inputProps={{
                            step: 100,
                            min: 0,
                            max: 9000,
                            type: 'number',
                            'aria-labelledby': 'input-slider',
                        }}
                    />
                </Grid>
            </Grid>
        </Box>
    );
}