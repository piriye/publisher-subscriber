export const Flags = {
  ACCEPTANCE_RATE_ID: 1,
  COMPLETION_RATE_ID: 2,
  CANCELLATION_RATE_ID: 3,
  UNRESPONSIVE_RATE_ID: 4,
  SAFETY_SCORE_ID: 5
};

export enum Action {
  unresponsive = 'unresponsive',
  acceptance = 'acceptance',
  cancelled_by_champion = 'cancelled_by_champion',
  cancelled_by_customer = 'cancelled_by_customer',
  completed = 'completed'
}
